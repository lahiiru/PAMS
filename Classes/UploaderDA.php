<?php
/*
 * @author: Chanka
 * @modified:
 *      Lahiru - Added error handler
 *             - Added transactions to mysql
 */


require_once 'auto_loader.php';
/*
    $up = new UploaderDA($jString);
    $up->upload();
*/
class UploaderDA {

private $connection;
private $recentActionId;
private $recentItemId;
private $recentBatchId;

private $author;
private $comment;
private $date;
private $itemType;
private $jDataArray;

private $errorfound=false;
private $customErrMsg='';

function myErrorHandler($errno, $errstr, $errfile, $errline) {  //Calls when error is occured
    if(!$this->errorfound){                                     //is the first time of calling error handler
        if(strpos($errstr, "Undefined index")!==FALSE){
            $this->customErrMsg.="It seems your workbook has stranger fields for type:$this->itemType.";
        }    
    }
    $this->errorfound=true;
}

function __construct($json) {
    
    set_error_handler(array($this, 'myErrorHandler'));
    
    $valueArray = json_decode($json, true);
    $indexArray = array_keys($valueArray);
    $this->author = $valueArray["Author"][1];
    $this->comment = $valueArray["Comment"];
    $this->date = $valueArray["Time"][0];
    $this->itemType = $indexArray[0];
    $this->jDataArray = $valueArray[$this->itemType];
   
    $this->getConnection();
}




public function upload(){
    $this->startTransaction();
    $this->createBatch();
    $this->createAction("b");
    $this->insertBatchActionMap();
    foreach ($this->jDataArray as $record) {
            $this->createItem($record);
            $this->createAction("i");
            $this->insertItemActionMap();
            $this->insertItemBatchMap();
        }
        if($this->errorfound){
            $this->discardChanges();
            return ["alert-error", "Records were not uploaded. Error while uploading.<br>$this->customErrMsg"];
        }else{
            $this->commitChanges();
            return ["alert-success", "Annexures successfully uploaded . <b>Batch id for the last action is " . $this->recentBatchId . '</b>'];
        }
    }

private function createBatch(){
    try{
        mysqli_query($this->connection, "INSERT INTO `project`.`batches` (`id`) VALUES (NULL)");
        $this->recentBatchId= mysqli_insert_id($this->connection);
        return "successful";
    }catch(Exception $e){
        return "Insert to batches operation faild";
    }
}

private function createAction($relation){
        mysqli_query($this->connection, "INSERT INTO `actions` (`relation`,`type`,`author`,`comment`) VALUES ('$relation','CRE','$this->author','$this->comment')");
        $this->recentActionId= mysqli_insert_id($this->connection);
}
private function startTransaction(){
    mysqli_query($this->connection,"START TRANSACTION");
}
private function commitChanges(){
    mysqli_query($this->connection,"COMMIT");
}
private function discardChanges(){
    mysqli_query($this->connection,"ROLLBACK");
}

private function createItem($record){
    $ifac = new ItemDAFactory();
    $ifac->getDAobj($this->itemType, $record, $this->recentActionId)->getQueryStr();
    $ifac->getDAobj($this->itemType, $record, $this->recentActionId)->updateDB($this->connection);
    $this->recentItemId= mysqli_insert_id($this->connection);
}


private function insertItemActionMap(){
    $sql="INSERT INTO `item_action_map` (`itemid`,`actionid`) VALUES ('$this->recentItemId','$this->recentActionId')";
    mysqli_query($this->connection,$sql) or die(mysqli_error($this->connection));
}

private function insertItemBatchMap(){
    mysqli_query($this->connection,"INSERT INTO `item_batch_map` (`itemid`,`batchid`) VALUES ('$this->recentItemId','$this->recentBatchId')");
}

private function insertBatchActionMap(){
        mysqli_query($this->connection,"INSERT INTO `batch_action_map` (`batchid`,`actionid`) VALUES ('$this->recentBatchId','$this->recentActionId')");
}

private function getConnection(){
    $dLink = new DataLink("batches");
    $this->connection=$dLink->getConnection();
}

}

?>

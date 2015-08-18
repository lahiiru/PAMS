<?php
/*
 * @author = Chanaka
 *      - update all the databases related to uploading an annexure ( maybe after editing)
 */


require_once 'auto_loader.php';
/*
$jString = '{
        "DLG": [
            {
                "EMP No": "1235",
                "EPF No": "0015",
                "Name": "Cruise",
                "Company": "LOMC",
		"Department": "abc",
		"Corporate Title": "Clerk",
		"Dialog deductions": "200.15"
            },
            {
                "EMP No": "1236",
                "EPF No": "0017",
                "Name": "Justin",
                "Company": "LOMC",
		"Department": "abcd",
		"Corporate Title": "Manager",
		"Dialog deductions": "2444.15"
            },
            {
                "EMP No": "1287",
                "EPF No": "0010",
                "Name": "Beiber",
                "Company": "LOLC",
		"Department": "abb",
		"Corporate Title": "Mover",
		"Dialog deductions": "1877.20"
            }
        ],
	"Comment": "This is the new sample of DLG item json",
	"Author": ["JALP Jayakody","2000"],
	"Time": ["2015/08/01","08:05 am"]
}';
$up = new Uploader($jString);
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


function __construct($json) {
    
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
   
    $this->createBatch();
    $this->createAction("b");
    $this->insertBatchActionMap();
    foreach ($this->jDataArray as $record) {
            $this->createItem($record);
            $this->createAction("i");
            $this->insertItemActionMap();
            $this->insertItemBatchMap();
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
    try{
        mysqli_query($this->connection, "INSERT INTO `actions` (`relation`,`type`,`author`,`comment`) VALUES ('$relation','CRE','$this->author','$this->comment')");
        $this->recentActionId= mysqli_insert_id($this->connection);
        return "successful";
    }catch(Exception $e){
        
    }
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
    try{
        mysqli_query($this->connection,"INSERT INTO `batch_action_map` (`batchid`,`actionid`) VALUES ('$this->recentBatchId','$this->recentActionId')");
        return "successful";
    }catch(Exception $e){
        
    }
}

private function getConnection(){
    $dLink = new DataLink("batches");
    $this->connection=$dLink->getConnection();
}

}

?>

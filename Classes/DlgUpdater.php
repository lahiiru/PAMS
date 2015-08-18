<?php
require_once ('auto_loader.php');
//testing start from here
$jsn='{
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

$jsn1='{
        "MBT": [
            {
                "EMP No": "1235",
                "EPF No": "0015",
                "Name": "Cruise",
                "Company": "LOMC",
		"Department": "abc",
		"Corporate Title": "Clerk",
		"Mobitel deductions": "200.15"
            },
            {
                "EMP No": "1236",
                "EPF No": "0017",
                "Name": "Justin",
                "Company": "LOMC",
		"Department": "abcd",
		"Corporate Title": "Manager",
		"Mobitel deductions": "2444.15"
            },
            {
                "EMP No": "1287",
                "EPF No": "0010",
                "Name": "Beiber",
                "Company": "LOLC",
		"Department": "abb",
		"Corporate Title": "Mover",
		"Mobitel deductions": "1877.20"
            }
        ],
	"Comment": "This is the new sample of MBT item json",
	"Author": ["JALP Jayakody","2000"],
	"Time": ["2015/08/01","08:05 am"]
}';


//testing over here
/**
 * Description of DlgUpdater
 *
 * @author Nuwan Rathnayaka
 */
//$d=new DlgUpdater($jsn);
$s1=new DlgUpdater($jsn1);

class DlgUpdater {
    private $itemType = null;     // data getting from the jason string
    private $jDataArray = null;
    private $author = null;
    private $comment = null;
    private $date = null;
    private $conn = null;
    private $batchId;
    private $type = "CRE";
    private $recentActionID;
    private $recentBatchID;
    private $recentItem;
    private $recentEmpDetails;
    private $recentbatchesItem;
    
    public function __construct($jString){
        $this->connect();
        //$this->updateDlgitems();
        
        $valueArray = json_decode($jString, true);
        //print_r($valueArray);
        $indexArray = array_keys($valueArray);
        $this->author = $valueArray["Author"][1];
        $this->comment = $valueArray["Comment"];
        $this->date = $valueArray["Time"][0];
        $this->itemType = strtolower($indexArray[0]);
        $this->jDataArray = $valueArray[strtoupper($this->itemType)];
        //print_r($this->jDataArray);
        
        
        $this->updateDB();
        
    }

    public function updateItems(){
        $dataarray=array();
        $sql='SELECT * FROM '.$this->itemType.'batches';
        $query=mysqli_query($this->conn, $sql)or die(mysqli_error($this->conn));
        while ($row = mysqli_fetch_assoc($query)) {
            //array_push($dataarray, $row["actions"]);
            $entry=$row["actions"];
            $itemArray=explode(';',$entry,-1);
            foreach ($itemArray as $key => $value) {
                
            }
            //print($entry);
            //print($entry[0]);
            
            print_r($itemArray);
        }
        
    }
    
    public function connect(){
        $db=new DataLink("batches");
        $this->conn=$db->getConnection();
        if($this->conn==null){
            echo "Error opening Database";
        }else{
            //echo "succefully opened the database";
        }
    }
    
    
    public function updateDB() {
       // mysqli_query($this->conn, "INSERT INTO actions (`comment`,`author`,`type`,`date`) VALUES('$this->comment','$this->author','$this->type','$this->date')") or die(mysqli_error($this->conn));
        //get the recent actionID
        //$recent_action = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id FROM actions ORDER BY id DESC LIMIT 1"), MYSQLI_NUM);
       // $this->recentActionID = $recent_action[0];
        
        //create a new batch with recenlty added action-id
       // mysqli_query($this->conn, "INSERT INTO batches (`items`,`actions`) VALUES ('','$this->type-$this->recentActionID;')");

        if ($this->conn != null) {
            try {
                $this->updateActions();
                $this->updateBatchesTables();
                //print_r($this->jDataArray);
                
                //get the recently working row in the batchesdlg
        $recent_action = mysqli_fetch_array(mysqli_query($this->conn, "SELECT batchid FROM $this->itemType"."batches ORDER BY batchid DESC LIMIT 1"), MYSQLI_NUM);
        print_r($recent_action);
        $this->recentbatchesItem = $recent_action[0];
        print($this->recentbatchesItem);
               
                foreach ($this->jDataArray as $record){
                
                    $this->updateItem($record);
                    //get the recent item id
                    $r=mysqli_query($this->conn, "SELECT id FROM item$this->itemType ORDER BY id DESC LIMIT 1");
                     $recent_action = mysqli_fetch_array($r, MYSQLI_NUM);
                     $this->recentItem= $recent_action[0];
                    //$this->updateEmpdetail();
                     
                    $this->mapTable();
                }
            } catch (Exception $e) {
                return ["alert-error", "Records were not uploaded. Error while uploading."];
            }
            return ["alert-success", "Annexures successfully uploaded . <b>Batch id for the last action is " . $this->batchId . '</b>'];
            //}
        } else {
            return ["alert-error", "Records were not uploaded. Cannot connect to the database."];
        }
    }
    
    public function mapTable(){
        echo $this->recentbatchesItem.'   ';
        echo $this->recentItem;
        
        $sql="INSERT INTO $this->itemType"."_batch_item_map (`batchid`,`itemid`) VALUES ('$this->recentbatchesItem','$this->recentItem')";
        mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn)) ;
        echo "successfully map";
    }


    private function updateItem($record) {
        $ifac = new ItemDAFactory();
        $itemDAobj=$ifac->getDAobj($this->itemType, $record, $this->recentActionID);
        $itemDAobj->updateDB($this->conn);
    }
    
     private function updateActions() {
        mysqli_query($this->conn, "INSERT INTO actions (`comment`,`author`,`type`,`date`) VALUES('','$this->author','$this->type','$this->date')") or die(mysqli_error($this->conn));
        //get the last actions ID
        //$lastInsertID=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
        //get the recent batches id        //$sql = "SELECT LAST_INSERT_ID()";
        //get the recent action id
        $s = mysqli_query($this->conn, "SELECT id FROM actions ORDER BY id DESC LIMIT 1");
        $aid = mysqli_fetch_array($s, MYSQLI_NUM);
        $this->recentActionID = $aid[0];
        
        //get the recent batch id in batches table
        $s = mysqli_query($this->conn, "SELECT batchid FROM batches ORDER BY batchid DESC LIMIT 1");
        $bid = mysqli_fetch_array($s, MYSQLI_NUM);
        $this->recentBatchID = $bid[0];          //recently used batch ID
        
        //call the updateEmp_batches() method
        $this->updateEmp_batches();
        
        /*check the batch is DLGutem and enter to table
        $sql="SELECT items FROM batches WHERE batchid=$this->recentBatchID";
        print($this->recentActionID);*/
       
     }
     
     public function updateBatchesTables(){
        /*$str=mysqli_fetch_array( mysqli_query($this->conn, $sql));
        $get=  strtolower(substr($str[0], 0, 3)) ; //geth the item type*/
         $item=strtolower($this->itemType);
        $sql="INSERT INTO $item"."batches (`actions`) VALUES ('CRE-$this->recentActionID')";
   
        mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));

     }
     
     //this function updates the empdetail_batches_map table with the comming of a new batch 
     public function updateEmp_batches(){
         $sql="INSERT INTO empdetail_batches_map (`empno`,`batchid`) VALUES ('$this->author','$this->recentBatchID')";
         mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
     }
}

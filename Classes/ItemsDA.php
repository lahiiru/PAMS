<?php

/*
 * @author: Chanaka
 * Item Data Access Class.
 * This class is responsible for updating the database.
 * @modified:
 *      Nuwan   -   Connect the database using DataLink class object.
 *      Nuwan   -   Edit the update comment in batches table using updateComments method.
 *      Chanaka -   Re-Organized functions to minimize cohesion.
 *      Lahiru  -   Renamed updateItemDlg to updateItem. Modified it to use 
 *                  ItemDAFactory.
 *                  Replaced "itemdlg"
 *                  with `item" . strtolower($this->itemType) . "`
 *                  to generalized for all types.
 */

class ItemsDA {

    private $itemType = null;     // data getting from the jason string
    private $jDataArray = null;
    private $author = null;
    private $comment = null;
    private $date = null;
    private $conn = null;
    private $host = "localhost";    // details about database
    private $username = "root";
    private $password = "";
    private $dbName = "project";
    private $batchId;
    private $type = "CRE";
    private $recentActionID;
    private $recentBatchID;
    private $recentItemslg;
    private $recentEmpDetails;

    public function __construct($jString) {
        /*
         * convert json string into an array store in 'valueArray'
         * indexArray takes all the keys from valueArray
         * jDataArray stores all the data of item values
         */
        //echo $jString;
        $valueArray = json_decode($jString, true);

        $indexArray = array_keys($valueArray);
        $this->author = $valueArray["Author"][1];
        $this->comment = $valueArray["Comment"];
        $this->date = $valueArray["Time"][0];
        $this->itemType = $indexArray[0];
        $this->jDataArray = $valueArray[$this->itemType];

        $this->connectDB();
    }

    public function updateDB() {

        //create a batch in batches table with empty items field
        //create a new action
        mysqli_query($this->conn, "INSERT INTO actions (`comment`,`author`,`type`,`date`) VALUES('$this->comment','$this->author','$this->type','$this->date')") or die(mysqli_error($this->conn));

        //get recently added action from actions table and find its id
        $recent_action = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id FROM actions ORDER BY id DESC LIMIT 1"), MYSQLI_NUM);
        $this->recentActionID = $recent_action[0];

        //create a new batch with recenlty added action-id
        mysqli_query($this->conn, "INSERT INTO batches (`items`,`actions`) VALUES ('','$this->type-$this->recentActionID;')");

        if ($this->conn != null) {
            //if ($this->itemType == 'DLG') {
            try {
                $this->updateActions();
                foreach ($this->jDataArray as $record) {
                    $this->updateItem($record);
                    $this->updateEmpdetail();
                    $this->updateBatches();
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

    //connect to the database
    private function connectDB() {
        //edit:nuwan
        //$this->conn = mysqli_connect($this->host, $this->username, $this->password);
        $obj = new DataLink("batches");
        $this->conn = $obj->getConnection();
        if ($this->conn != null) {
            mysqli_select_db($this->conn, $this->dbName);
        }
    }

    //update the item tables
    private function updateItem($record) {

        /* edited by lahiru
          $empNo = $record["EMP No"];
          $epfNo = $record["EPF No"];
          $name = $record["Name"];
          $company = $record["Company"];
          $department = $record["Department"];
          $cTitle = $record["Corporate Title"];
          $dDeduction = $record["Dialog deductions"];
          //get the recently working action ID

          $prefix = "CRE";
          $lastActionID = $prefix . "-" . $this->recentActionID;

          mysqli_query($this->conn, "INSERT INTO itemdlg (`empno`,`epfno`,`name`,`company`,`department`,`corporatetitle`,`dialogdeductions`,`actions`) VALUES('$empNo','$epfNo','$name','$company','$department','$cTitle','$dDeduction','$lastActionID;')") or die(mysqli_error($this->conn));

         *///          $this->updateEmpdetail();
//            $this->updateBatches();
        $ifac = new ItemDAFactory();
        $itemDAobj=$ifac->getDAobj($this->itemType, $record, $this->recentActionID);
        $itemDAobj->updateDB($this->conn);
    }

    //update bathces table
    private function updateBatches() {
        // tablename can change

        $n = mysqli_query($this->conn, "SELECT * FROM `item" . strtolower($this->itemType) . "` ORDER BY id DESC LIMIT 1");
        $rc = mysqli_fetch_array($n, MYSQLI_NUM);

        //get recently used batchid
        $s = mysqli_query($this->conn, "SELECT batchid FROM batches ORDER BY batchid DESC LIMIT 1");
        $bid = mysqli_fetch_array($s, MYSQLI_NUM);
        $value = $this->itemType . $rc[0] . ';';

        mysqli_query($this->conn, "UPDATE batches SET batches.items = concat(batches.items,'$value') WHERE batchid=$bid[0]");
        $this->batchId = $bid[0];
    }

    //update actions table
    private function updateActions() {
        mysqli_query($this->conn, "INSERT INTO actions (`comment`,`author`,`type`,`date`) VALUES('','$this->author','$this->type','$this->date')") or die(mysqli_error($this->conn));
        //get the last actions ID
        $sql = "SELECT LAST_INSERT_ID()";
        //$lastInsertID=mysqli_query($this->conn,$sql) or die(mysqli_error($this->conn));
        //get the recent batches id
        $s = mysqli_query($this->conn, "SELECT batchid FROM batches ORDER BY batchid DESC LIMIT 1");
        $bid = mysqli_fetch_array($s, MYSQLI_NUM);
        $this->recentBatchID = $bid[0];          //recently used batch ID
        //get the recent action id
        $s = mysqli_query($this->conn, "SELECT id FROM actions ORDER BY id DESC LIMIT 1");
        $aid = mysqli_fetch_array($s, MYSQLI_NUM);
        $this->recentActionID = $aid[0];
//        $this->updateItem();
        //******************set the comment column in the batches table to the recant value ************************************
//        $prefix = "CRE";
//        $lastActionID = $prefix . '-' . $this->recentActionID;
//
//        $temp = $this->recentBatchID;
    }

    //update empdetail table
    private function updateEmpdetail() {
        //find last record (recennlty updated record) and get id  ** here tablename can change
        $n = mysqli_query($this->conn, "SELECT * FROM `item" . strtolower($this->itemType) . "` ORDER BY id DESC LIMIT 1");
        $rc = mysqli_fetch_array($n, MYSQLI_NUM);
        $this->recentEmpDetails = $rc[1];
        $value = $this->itemType . $rc[0];
        mysqli_query($this->conn, "UPDATE empdetail SET empdetail.pendingitems = concat(empdetail.pendingitems,'$value;') WHERE empno=$this->recentEmpDetails");
    }


    public  function  approveItem()
    {
        //create a batch in batches table with empty items field
        //create a new action
        mysqli_query($this->conn, "INSERT INTO actions (`comment`,`author`,`type`,`date`) VALUES('$this->comment','$this->author','$this->type','$this->date')") or die(mysqli_error($this->conn));

        //get recently added action from actions table and find its id
        $recent_action = mysqli_fetch_array(mysqli_query($this->conn, "SELECT id FROM actions ORDER BY id DESC LIMIT 1"), MYSQLI_NUM);
        $this->recentActionID = $recent_action[0];

        //create a new batch with recenlty added action-id
        //mysqli_query($this->conn, "INSERT INTO batches (`items`,`actions`) VALUES ('','$this->type-$this->recentActionID;')");

        if ($this->conn != null) {
            //if ($this->itemType == 'DLG') {
            try {
                $this->updateActions();
                foreach ($this->jDataArray as $record) {
                    $this->updateItem($record);
                    $this->updateEmpdetail();
                    $this->updateBatches();
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

}

?>
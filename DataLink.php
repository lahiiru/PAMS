<?php

/* @author : Nuwan
 * $dl = new DataLink("Comments");
 * echo $dl->getTableName();
 * $dl->getConnection();
 */

class DataLink {

    //$array contains the relevant database and the table
    private $arr = array(
        "members" => ["members", "users"],
        "roles" => ["roles", "users"],
        "batches" => ["batches", "project"],
        "comments" => ["comments", "project"],
        "empdetails" => ["empdetail", "project"],
        "itemdlg" => ["itemdlg", "project"]
    );
    private $dbname;
    private $tableName;
    private $returnConn; // connection variable relevant to the table name 
    private $myName;  //holds the table name.
    private $entry;     //entry takes the relevant entry from the $array. ex:$entry=["members","users"] likewise
    private $host = "localhost";
    private $user = "root";
    private $pass = "";

    public function __construct($name) {
        $this->myName = strtolower($name);  //convert string into lowercase
        $this->selectEntry();
    }

    public function getConnection() {
        $this->returnConn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        return $this->returnConn;
    }

    //set the myName to values
    public function selectEntry() {
        if (array_key_exists($this->myName, $this->arr)) {
            //echo "Table exists in the System.";
            $this->entry = $this->arr[$this->myName];
            $this->dbname = $this->entry[1];                //dbname set to the 1st element of the entry
            $this->tableName = $this->entry[0];             //tablename set the 0th element of the entry
            //print_r($this->entry);
            //print($this->entry[0]);
        } else {
            //echo "no such a table";
        }
    }

    public function getTableName() {
        return $this->tableName; //return the oth element of the entry and which is the Table name.
    }

    public function getDataBaseName() {
        return $this->dbname;  //rteurn the 1st element of the entry array and which is the relevant database name. 
    }

}

?>
<?php
require_once ('auto_loader.php');
/**
 * Created by PhpStorm.
 * User: Niroshan
 * Date: 8/8/2015
 * Time: 11:12 AM
 */


/*******************************************************************************
 *This Class can return associative array of all pending,Approved,Rejected item company wise and its include all the  employee
 * information and feeder , approved officer information
 *
 *
 * below some description about public method
 *
 * getPendingItems($feeding_information",$relevent_company)); -> this method return all information about one feeding information
 * getAllItem()                                                -> this method return all information about company
 *
 * */

$da=new requestDA("CRE","LOMC");
$g=$da->getCountNotifiaction();
if(array_key_exists("RSG",$g))
{

}
else{

}


//print_r($da->getFeedingInfo(1));
//print_r($da->getNotifiaction());
//$array=$da->getItem("itemmbt");
//$s=json_encode($array,true);
//print_r($da->getActionItemGivenType("","DLG"));



class RequestDA {

    private $company;
    private $actiontype;
    private $conn;
    private $dbName;
    private $feedingItem;
    private $itemtype;
    private $item;
    public function __construct($actiontype,$company){
        $this->company=$company;
        $this->actiontype=$actiontype;
        $this->conn=null;
        $this->dbName="project";
        $this->feedingItem=array("itemdlg","itemfst","itemlne","itemlns","itemmdc","itemmbt","itemrmt","itemnpy","itemovt","itemrsg");
        $this->itemtype=array("DLG","FST","LNE","LNS","MDC","MBT","RMT","NPY","OVT","RSG");

       // print_r($this->feedingItem);
    }

    public function getActionItemGivenType($action,$type){
        $this->connectDB("actions");
        $dataarray=array();

        $query="SELECT u.*, s.* ,k.* FROM actions u inner join item_action_map s inner JOIN items k ON u.id = s.actionid  and s.itemid=k.id and k.itemtype='".$type."' and k.company='".$this->company."' WHERE u.type != 'REG' ";


        if ($result = mysqli_query($this->conn, $query)) {
            /* fetch associative array */
            while ($row = mysqli_fetch_assoc($result)) {

                foreach($result as $rw=>$data){

                    array_push($dataarray,$data);

                    //echo '</br>';
                }

               // echo sizeof($dataarray);

            }


            mysqli_free_result($result);
        }

        else{
            echo "no data item";
        }

        mysqli_close($this->conn);

        return $dataarray;

    }


    public function getAllactionItem(){
        $allSelectedData=array();
        //repeatedly inspect all tables and get all relevent data using getItem() method
        foreach($this->itemtype as $key => $item){
            $dataarray=$this->getActionItemGivenType("",$item);
            //print_r($dataarray);
            // echo '</br>';

            if(!empty($dataarray)){
                //array_push($allSelectedData,$this->getItem($feedinginfo));
                $allSelectedData[$item]=$dataarray;
            }

        }

        print_r($allSelectedData);

    }

    public function getCountNotifiaction(){

        foreach($this->itemtype as $key => $item){
            $dataarray=$this->getActionItemGivenType("",$item);
            //print_r($dataarray);
            // echo '</br>';

            if(!empty($dataarray)){
                //array_push($allSelectedData,$this->getItem($feedinginfo));
                $allSelectedData[$item]=sizeof($dataarray);
            }

        }
       return $allSelectedData;
    }



    public function getHTML($array){
        $htmltable=' <table width="100%" cellspacing="0" class="display" id="datatable">';
        foreach($array as $raw=>$data){
            foreach($data as $key=>$value){
                echo $value;
            }

        }
    }































    /*
     * This method return notifaicaton of pending or approved item
     *
     */






































































    public function getNotifiaction(){
        $allitemarray=$this->getAllItem();
        $notificationtype=array_keys($allitemarray);
        $notifiactionarray=array();
        foreach($allitemarray as $tab=>$data){
            $notifiactionarray[$tab]=sizeof($data);
        }
        return $notifiactionarray;
    }

    /*******************************************************************************
     *This method also connect with relevent database and query data in relevent table with forein key relataed table and  return  information about some item
     * */
    // accept a table name of $table and return the relevent details.


    public function  getItem($table)
    {
        $this->connectDB($table);
        $dataarray=array();


        $query="SELECT u.*, s.* FROM ".$table." u inner join empdetail s on u.empno = s.empno WHERE u.company ='".$this->company."'";


        if ($result = mysqli_query($this->conn, $query)) {
            /* fetch associative array */
            while ($row = mysqli_fetch_assoc($result)) {
                    if(substr($row["actions"],0,3)=='CRE') {
                        array_push($dataarray, $row);
                    }

            }


            mysqli_free_result($result);
        }

        else{
            //echo "no data item";
        }

        mysqli_close($this->conn);
        return $dataarray;

    }

    /*******************************************************************************
     *This method return all data in company by using getItem() method
     *
     * 
    public function getAllItem()
    {
        $all_selected_data=array();
        foreach ($this->feedingItem as $key => $feedinginfo) {

            array_push($all_selected_data,$this->getItems($feedinginfo,"LOMC"));

        }
        return $all_selected_data;

    }*/

/*******************************************************************************
 * This is database connection creation method
 * */

    private function connectDB($table) {
        $obj=new DataLink($table);
        $this->conn=$obj->getConnection();
        if($this->conn !=null){
            //echo "Connection created Successfully!";
        }
        else{
            echo "DataBase conection Error!!";
        }
    }


/******************************************************************************
    *this fuction returns all the pending items from all tables
    *Modified by: Nuwan 
 */
public function getAllItem(){
        $allSelectedData=array();  
        //repeatedly inspect all tables and get all relevent data using getItem() method
        foreach($this->feedingItem as $key => $feedinginfo){
            $dataarray=$this->getItem($feedinginfo);
           //print_r($dataarray);
           // echo '</br>';

            if(!empty($dataarray)){
                //array_push($allSelectedData,$this->getItem($feedinginfo));
                $allSelectedData[$feedinginfo]=$this->getItem($feedinginfo);
            }

        }

        return $allSelectedData;
    }
    

    
 public function getFeedingInfo($id)
 {
     $this->connectDB("actions");
     $actioninfo=array();
     $query="SELECT date,author,comment FROM actions WHERE id=".$id;
     if ($result = mysqli_query($this->conn, $query)) {
         /* fetch associative array */
         $actioninfo= mysqli_fetch_assoc($result);

         mysqli_free_result($result);
     }
    return $actioninfo;

 }

public function getFeederInfo($empid){
    $this->connectDB("actions");
    $actioninfo=array();
    $query="SELECT epfno,empno,name,company,gender,nic,designation,roles FROM empdetail WHERE id=".$empid;
    if ($result = mysqli_query($this->conn, $query)) {
        /* fetch associative array */
        $actioninfo= mysqli_fetch_assoc($result);

        mysqli_free_result($result);
    }
    return $actioninfo;
}
    
}
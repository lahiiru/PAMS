<?php

/* @author - Chanaka
 *      class for inquery items from tables
 * 
 *         **** items search has not completed yet
 */

class InquiryDA{
    private $dbConnection;
    private $tableName;
    
    /*
     * searchByEmpNo
     *  - for values search by employee numbers
     *  - return the relevent record for searched value
     *  - if not return null
     */   
    
    public function searchByEmpNo($empNo){
        $searchFor = $empNo;
        $this->getConnectionDetail("empdetails");
        return $this->getData("*","empno", $searchFor,FALSE);
        
    }
    
    /*
     * searchByBatchNo
     *  - for values search by batch id numbers
     *  - return the relevent record for searched value
     *  - if not return null
     */
    
    public function searchByBatchNo($batchNo){
        $searchFor = $batchNo;
        $this->getConnectionDetail("batch_action_map");
        $aid= $this->getData("actionid","batchid", $searchFor,FALSE);
        if($aid==NULL){
            echo ("mekata awee");
            return $aid;
        }else{
            $result=["batchid"=>$batchNo];
            $this->tableName="item_batch_map";
            $itemResult=$this->getData("itemid","batchid",$batchNo,TRUE);
            $result += $itemResult;
            $this->tableName="actions";
            $actionResult=$this->getData("id AS actionid,relation,type,date,author,comment","id",$aid["actionid"],FALSE);
            $result += $actionResult;            
            return $result;
        }
            
       
    }
    
    /*
     * searchByItemNo
     *  - for values search by item id
     *  - find the correspond table from given id
     *  - return the relevent record for searched value
     *  - if not return null
     */
    
    public function searchByItemNo($itemNo){
        $searchFor = strtolower($itemNo);

//        $itemType=substr($searchFor,0,3);
//        $itemid=  substr($searchFor, 3);
        
//        switch ($itemType){
//            case "dlg":
//                $this->getConnectionDetail("itemdlg");
//                return $this->getData("*","id", $itemid);
//            case "fst":
//                $this->getConnectionDetail("itemfst");
//                return $this->getData("*","id", $itemid);
//            case "lne":
//                $this->getConnectionDetail("itemlne");
//                return $this->getData("*","id", $itemid);
//            case "lns":
//                $this->getConnectionDetail("itemlns");
//                return $this->getData("*","id", $itemid);                
//            case "mbt":
//                echo "awaa";
//                $this->getConnectionDetail("itemmbt");
//                return $this->getData("*","id", $itemid);
//            case "npy":
//                $this->getConnectionDetail("itemnpy");
//                return $this->getData("*","id", $itemid);
//            case "ovt":
//                $this->getConnectionDetail("itemovt");
//                return $this->getData("*","id", $itemid);
//            case "rmt":
//                $this->getConnectionDetail("itemrmt");
//                return $this->getData("*","id", $itemid);
//            case "rsg":
//                $this->getConnectionDetail("itemrsg");
//                return $this->getData("*","id", $itemid);
//            default:
//                return null;
//        }
    }
    
    /*
     * searchByActionNo
     *  - for values search by action id
     *  - return the relevent record for searched value
     *  - if not return null
     */
    
    public function searchByActionNo($actionNo){
        $searchFor = $actionNo;
        $this->getConnectionDetail("actions");
        $actionResult= $this->getData("*","id", $searchFor,FALSE);
        if($actionResult["relation"]=="b"){
            $this->tableName="batch_action_map";
            $batchResult=$this->getData("batchid","actionid", $actionResult["id"],FALSE);
            return $actionResult+$batchResult;
        }elseif($actionResult["relation"]=="i"){
            $this->tableName="item_action_map";
            $itemResult=$this->getData("itemid","actionid", $actionResult["id"],FALSE);
            return $actionResult+$itemResult;
        }else{
            return $actionResult;
        }
    }
    
    /*
     * getConnectionDetail
     *  - get the connection to database using DataLink class
     *  - get connection and table names
     */
    
    private function getConnectionDetail($name){
        $dataLink= new DataLink($name);
        $this->dbConnection=$dataLink->getConnection();
        $this->tableName=$dataLink->getTableName();
    }
    
    /*
     * getData
     *  - return requested data from requested table and searching values
     */
    private function getData($selectValue,$condition1,$condition2,$sameValueSelect){
        try{
            $query="SELECT $selectValue FROM $this->tableName WHERE $condition1='$condition2'";
//            echo $query;
            $query_result = mysqli_query($this->dbConnection,$query);
//            print_r($query);
            
            if($sameValueSelect){
                $string='';
                while ($row = mysqli_fetch_assoc($query_result)) {
                    $string .= $row[$selectValue].",";
                }
                $resultArray=[$selectValue=>$string];
                return $resultArray;
            }else{
                return mysqli_fetch_assoc($query_result);
            }
           
//            return $array;
        }catch(Exception $e){
            return null;
        }
    }
}

?>
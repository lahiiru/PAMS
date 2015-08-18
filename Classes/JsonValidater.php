<?php
/**
 * Created by PhpStorm.
 * User: Niroshan
 * Date: 8/14/2015
 * Time: 3:50 PM
 */
require_once('auto_loader.php');

/*
 * This class can return validated information as Associative Array for given json string
 * it can do my calling getErrorCollection() method
 *
 */

$strh='{"DLG":[{"EMP No": "1234","EPF No": "53","Name": "R.M.P.Jayaweera7","Company": "LOMC","Department": "Finace1","Corporate Title": "Employee1","Dialog deductions": "123N4.9"},{"EMP No": "1456","EPF No": "789","Name": "T.M.L.Ranga","Company": "LOLC","Department": "Loan","Corporate Title": "Employee","Dialog deductions": "456.9"},{"EMP No": "1235","EPF No": "123","Name": "N.M.P.Rathnayake","Company": "LOLC","Department": "Loan","Corporate Title": "Manager","Dialog deductions": "2345.8"},{"EMP No": "2000","EPF No": "154","Name": "JALP Jayakody","Company": "LOITS","Department": "SD","Corporate Title": "SD","Dialog deductions": "10.5"},{"EMP No": "2001","EPF No": "155","Name": "BMC Rathnayaka","Company": "LOITS","Department": "SD","Corporate Title": "SDM","Dialog deductions": "200.1"},{"EMP No": "2002","EPF No": "156","Name": "AMNB Rathnayaka","Company": "LOITS","Department": "SD","Corporate Title": "SDM","Dialog deductions": "10000"},{"EMP No": "2003","EPF No": "157","Name": "RDN Ranapathi","Company": "LOITS","Department": "SD","Corporate Title": "SDM","Dialog deductions": "500.5"}]}';
$frame=new FrameGUI();
$json=new JsonValidater($strh);
$frame->echoHeader();
if($json->hasError()){
    $massage='Error Found !';
}
else{
    $massage='File is succesfully uploaded';
}
echo '<a href="#myModal" data-toggle="modal" class="btn btn-primary">Error Founded !</a>';
echo '<div id="myModal" class="modal hide">
											<div class="modal-header">
												<button data-dismiss="modal" class="close" type="button">&times;</button>
												<h3>'.$massage.'</h3>
											</div>
                                            <div class="modal-body">'.$json->getErrorMassage($json->getErrorCollection()) .'</div>
      </div>';


//$frame->echoBlock("erroe",$json->getErrorMassage($json->getErrorCollection()));
//print_r($json->getErrorCollection());
$frame->echoFooter();


class JsonValidater {
    private $json;
    private  $errorcollection;
    public function __construct($json){
      $this->json=json_decode($json,true);
        $this->errorcollection=array();



    }
/*
 * This method check all the data and push (rawnumber,columnnumber,Column Name, Error massage ) to error collecton array
 */
    private function pushValidation(){
        foreach($this->json as $tabletype=>$table){
            foreach($table as $datarow=>$raw){
                 foreach($raw as $title=>$value){

                     if(!$this->validateDatawithColumn($title,$value)==''){
                         array_push($this->errorcollection,array($datarow,$this->getCulumnNumber(array_keys($raw),$title),$title,$this->validateDatawithColumn($title,$value),$raw));

                     }
                 }
            }
        }

    }

    /*
     * This method return error collecton array
     */
    public function  getErrorCollection(){
        $this->pushValidation();
    return $this->errorcollection;
    }

    /*
     * This method return column number for given table and column name
     */
    private function getCulumnNumber($array,$column){
        foreach ($array as $key=>$columnname){
            if($columnname==$column){
                return $key;
            }
        }
    }

    /*
     * This method validate raw data by using FildValidator Object and return error massage
     */
    private function  validateDatawithColumn($title,$value){
        $feildvalidate=new FieldValidator($title,$value);
        return $feildvalidate->getError();
    }

    /*
     *
     */
    public  function  getErrorMassage($errorcollection){
           $massage= '';

        foreach($errorcollection as $errorrow=>$errordataarray){
            //print_r($errordataarray);
           $massage= $massage.$this->getSpecifiedErrorMassage($errordataarray[4],$errordataarray[3],$errordataarray[2]);

        }
        return $massage;

    }

    private function getSpecifiedErrorMassage($array,$error,$title){

        $errormassage='<table width="100%" cellspacing="0" class="table" id="datatable">
                    <thead><tr><th>'.'EMP No'.'</th><th>'.$title.'</th><th></th></tr></thead><tbody><tr>';
       foreach($array as $key=>$value)
       {
           if($key=="EMP No"){
               $errormassage=$errormassage.'<td>'.$value.'</td>';
           }

           else if($title==$key){
               $errormassage=$errormassage.'<td>'.$value.'</td>';
           }

       }
        $errormassage=$errormassage.'<td>'.$error.'</td></tr></tbody></table></br></br>';
        return $errormassage;

    }

    /*This method return boolean value for error collecton
     * Table does not have error it return false otherwise return true
     */
    public function hasError(){
        $arr=$this->getErrorCollection();
        if(empty($arr)){
            return false;
        }
        else{
            return true;
        }
    }

}
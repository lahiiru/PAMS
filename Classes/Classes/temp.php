<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of temp
 *
 * @author Nuwan Rathnayaka
 */
require_once ('auto_loader.php');

class temp {
    private $id=1;
    private  $htmltablestr='';
    public function getReadJson($json) {
        return  $this->getTable($json);
    }
    
    public function getEditJson($json) {
        return  $this->getTable($json,true);
    }
    
    private function getTable($json,$isEditable=false){
        
        $this->htmltablestr= ' <table width="100%" cellspacing="0" class="display" id="datatable">';
        $jsonString = json_decode($json,true);
        $keys = array();
        $this->htmltablestr=$this->htmltablestr. '<thead><tr>';
        //print_r($jsonString);
        //get headers and set table headers
        $headers = $this->getTableHeaders($jsonString);
        foreach ($headers as $columnName) {
            $this->htmltablestr=$this->htmltablestr. '<th>' . $columnName . '</th>';
        }
        $this->htmltablestr=$this->htmltablestr. '</tr></thead><tbody>';

        //set table data 
        //print_r($jsonString);
        
//<td><input type="checkbox" class="chkBox" value='.$this->id.'></td>
        
            foreach ($jsonString[array_keys($jsonString)[0]] as $key1 => $value1) {
                $rowid='row'.$this->id;
                $this->htmltablestr=$this->htmltablestr. '<tr>';
                foreach ($value1 as $key12 => $value12) {
                    if($isEditable){
                      
                        $this->htmltablestr=$this->htmltablestr.'<td>' . $value12 . '</td>';//<div class="col-lg-3"><input type="text"  style="width:100%;" value="'.$value12.'" ></div>

                    }else{
                     
                        $this->htmltablestr=$this->htmltablestr. '<td>' . $value12 . '</td>';

                    }
                }
                $this->id++;
                $this->htmltablestr=$this->htmltablestr. ' </tr>';
            }

        $this->htmltablestr=$this->htmltablestr. '</tbody></table>';

        
        return $this->htmltablestr;
    }

    private function getTableHeaders($itemArray){
        $headerArray = array();
        $index=0;
        //print_r($itemArray);
         foreach ($itemArray as $key => $value) {
            foreach ($value as $key1 => $value1) {
                foreach ($value1 as $key12 => $value12) {
                    $headerArray[$index]=$key12;
                    $index++;
                }
                break;
            }
            break;
        }
        return $headerArray;       
    }
}

<?php
require_once ('auto_loader.php');
/*
 * @author: Niroshan
 * 
 * modified : Chanaka
 *        add functions getTableHeaders and getVerticleTable functions
 */
//$strh='{"DLG":[{"EMP No": "1234","EPF No": "534","Name": "R.M.P.Jayaweera","Company": "LOMC","Department": "Finace","Corporate Title": "Employee","Dialog deductions": "1234.9"},{"EMP No": "1456","EPF No": "789","Name": "T.M.L.Ranga","Company": "LOLC","Department": "Loan","Corporate Title": "Employee","Dialog deductions": "456.9"},{"EMP No": "1235","EPF No": "123","Name": "N.M.P.Rathnayake","Company": "LOLC","Department": "Loan","Corporate Title": "Manager","Dialog deductions": "2345.8"},{"EMP No": "2000","EPF No": "154","Name": "JALP Jayakody","Company": "LOITS","Department": "SD","Corporate Title": "SD","Dialog deductions": "10.5"},{"EMP No": "2001","EPF No": "155","Name": "BMC Rathnayaka","Company": "LOITS","Department": "SD","Corporate Title": "SDM","Dialog deductions": "200.1"},{"EMP No": "2002","EPF No": "156","Name": "AMNB Rathnayaka","Company": "LOITS","Department": "SD","Corporate Title": "SDM","Dialog deductions": "10000"},{"EMP No": "2003","EPF No": "157","Name": "RDN Ranapathi","Company": "LOITS","Department": "SD","Corporate Title": "SDM","Dialog deductions": "500.5"}]}';
//// $JSONString = '{"Table":[{"EMP No": " 1234","EPF No": "534","Name": "R.M.P.Jayaweera","Company": "LOMC","Department": "Finace","Corporate Title": "Employee","Dialog deductions": "1234.9"},{"EMP No": "1456","EPF No": "789","Name": "T.M.L.Ranga","Company": "LOLC","Department": "Loan","Corporate Title": "Employee","Dialog deductions": "456.9"},{"EMP No": "1235","EPF No": "123","Name": "N.M.P.Rathnayake","Company": "LOLC","Department": "Loan","Corporate Title": "Manager","Dialog deductions": "2345.8"}]}';

/* create HTON object to convert JSON OBject to HTML Table and give html representaion for given data
 *
 */

//$HTMLTable=new HTON();

/* Method 01
 * This method return HTML table for given json string
 */
//echo $HTMLTable->getEditJson($json);


/*Method 02
 * This method return HTML Table for given for company,itemtype
 */


/*
$frame =new FrameGUI();
$frame->echoHeader();
$frame->echoBlock("LOMC",$HTMLTable->getSelectedItemItable("CRE","LOMC","DLG"));
$frame->echoFooter();
*/

class HTON {
    private $id=1;
    private  $htmltablestr='';
    /*
     * This method return html table for viewing does not access to edit
     */
    public function getReadJson($json) {
        return  $this->getTable($json);
    }

    /*
     * This method return html table for editing
     */
    public function getEditJson($json) {
        return  $this->getTable($json,true);
    }

    /*
     * This is private method this method retuen html table for given jason string
     */
    private function getTable($json,$isEditable=false){
        /*
         * Start table creation
         */
        $this->htmltablestr= ' <table width="100%" cellspacing="0" class="display" id="datatable">';
        /*
         * Decode json string
         */
        $jsonString = json_decode($json,true);
        $keys = array();


        $this->htmltablestr=$this->htmltablestr. '<thead><tr>';
        //print_r($jsonString);


        /*
         * get table headers to array
         */
        $headers = $this->getTableHeaders($jsonString);

        /*
         * set column title as Table Headder
         */
        foreach ($headers as $columnName) {
            $this->htmltablestr=$this->htmltablestr. '<th>' . $columnName . '</th>';
        }

        $this->htmltablestr=$this->htmltablestr. '</tr></thead><tbody>';

        //set table data 
        //print_r($jsonString);
        
        //<td><input type="checkbox" class="chkBox" value='.$this->id.'></td>

        /*
         * Add table cell values and fill table
         */
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
        /*
         * close table
         */
        $this->htmltablestr=$this->htmltablestr. '</tbody></table>';

        
        return $this->htmltablestr;
    }

    /*
     * This method return table header
     */
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


    /* Modified By Niroshan
     * added new method for get html string for pending,approve item by company wise
     */

    public function getSelectedItemItable($actiontype,$company,$itemtype){

        //create requestDA for access action companywise
        $da=new RequestDA($actiontype,$company);

        //get Action iten for given type (DLG,MBT,...etc)
        $array=$da->getActionItemGivenType("",$itemtype);





        //create TitleMapper obj for get relation ship column name and database table column name
        $map=new TitleMapper($itemtype);

        //get relationship
        $mapArr=$map->getMapXLS_SQL();

        //get database title  ex.  name, empno ,epfno ,...etc
        $title=array_values($mapArr);

        //get XLS title ex. Name, EMP No, EPF No
        $xlstitle=array_keys($mapArr);
        $htmltable= '<table width="100%" cellspacing="0" class="display" id="datatable"> ';
        $htmltable.='<thead><tr>'.$this->getTableTitleColumnHTML($xlstitle).'</tr>
                      </thead>'.'<tbody>';

        //set table row by row
        foreach ($array as $XLS=>$database) {
           $htmltable.='<tr>'.$this->getTableRaw($database,$title).'</tr>';
        }
        // close table
        $htmltable.='</tbody>
                    </table>';
        return $htmltable;

    }

/*This method return one table raw   Ex. <td> Nuwam </td> 931247867V <td>nuwan@gmail.com</td>
 *
 */
    private function getTableRaw($array,$title){
        $rawstr='';
        foreach ($title as $name){
            $rawstr .= '<td>'.$array[$name].'</td>';
        }
        return $rawstr;
    }

    /*
     * This method return Table title    ex:   <th> Name </th> NIC No <th>Email </th>
     */
    private  function getTableTitleColumnHTML($array){
        $htmlstr='';
        foreach ($array as $columnName) {
            $htmlstr=$htmlstr.'<th>'.$columnName.'</th>';
        }
        return $htmlstr;
    }

/*
 * getVerticleTable function
 *          - creates a verticle table
 *          - with two columns one is for header values and the other is for correspond valus
 */
    public function getVerticleTable($array){
        $result='';
        $headers=array_keys($array);
        $result = $result.'<table class="table table-bordered"><thead><tr><th>Field Name</th><th>Value</th></tr></thead><tbody>';      
        foreach($headers as $hd){
            $result = $result.'<tr><td>'.$hd.'</td><td>'.$array[$hd].'</td></tr>';
        }
        
        $result = $result. '</tbody></table></div></div>';
        return $result;
    }
}

?>
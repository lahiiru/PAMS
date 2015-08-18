<?php
/*
 * @author: Niroshan
 * @modified:
 * 
 */
include 'Classes/PHPExcel/IOFactory.php';

//require_once('auto_loader.php');
//
/*
  EMP No	EPF No	Name	Company	Department	Corporate Title	Dialog deductions
  1234	534	R.M.P.Jayaweera	LOMC	Finace	Employee	1234.9
  1456	789	T.M.L.Ranga	LOLC	Loan	Employee	456.9
  1235	123	N.M.P.Rathnayake	LOLC	Loan	Manager	2345.8
*/

  //create Xls2Json Object
/*
  $xls2josonObj=new XlsJSONParser('Table','Standards\Dialog Deduction.xlsx');
  //get json string
  $jsonstring=$xls2josonObj->getJsonString();
  echo $jsonstring;


*/

 

class XlsJSONParser {

    var $inputFileName;
    var $jsonstring;

    /*
     * Startt read xls file in constructor load file for read
     */
    public function __construct($filePath,$dataTitle) {
        $inputFileName = $filePath;
        $js = '"'.$dataTitle.'":[';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($filePath);
        }
        catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        /*
         * Load XLS File
         */

        $sheet = $objPHPExcel->getSheet(0);
        /*
         * Get XLS File Dimentions data contain
         */
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        /*
         * Get column title by reading XLS File
         */
        for ($row = 1; $row <= $highestRow; $row++) {
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            // $Data = $rowData = $sheet->rangeToArray( $row.'A'. ':' $highestRow.'A', NULL, TRUE, FALSE);

            foreach ($rowData[0] as $k => $v) {
                $v=strtoupper(str_replace(" ","",$v));

                if ($v == "EMPNO") {

                    $column = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

                    $keys = array_keys($column);
                    $datarow = $row;
                    break;
                }
            }
        }


        $js = '' . $this->jsonCreator($datarow, $highestRow, $highestColumn, $js, $sheet, $column);
        $js = $js . ']';
        //echo $this->jsonCreator($datarow,$highestRow,$highestColumn,$js,$sheet,$column);
        $this->jsonstring = $js;
    }

    /*
     * This method is created by perpose of read Resignation XLS FIle That is not completed
     */
    function resignation($rowData)
    {
        foreach ($rowData[0] as $k => $v)
            if ($v = strtoupper(str_replace(" ", "", $v)) == 'DUEAMOUNTS') {

            }
    }

    /*
     * This method return Tiletle column name when we
     */
    function columnecho($col, $key) {
        foreach ($col[0] as $k => $v) {
            if ($key == $k)
                return $v;
        }
    }

    /*
     * This  method  create json string by reading XLS Fle
     */
    function jsonCreator($datarow, $highestRow, $highestColumn, $js, $sheet, $column) {

        for ($row = $datarow + 1; $row <= $highestRow; $row++) {
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);
            $js = $js . '{';
            $flag = 0;
            $closebraket=true;
            foreach ($rowData[0] as $currentcolumn => $v) {
                if ($flag == 1) {
                    if(substr($js,-1)==","){
                        $js=substr($js, 0, -1);
                        continue;
                    }
                    $js = $js . ',';
                }

                if(!str_replace(" ","",$this->columnecho($column, $currentcolumn))==""){
                    if(str_replace(" ","",$v)==""){
                        $js = substr($js, 0, -1);
                        $closebraket=false;
                        break;
                    }
                    $js = $js . '"' . trim($this->columnecho($column, $currentcolumn)) . '":"'.$v.'"';
                    $flag = 1;
                }


            }
            if ($row == $highestRow&&$closebraket) {
                $js = $js . '}';

            }
            else if($closebraket){
                $js = $js . '},';
            }
            if ($row == $highestRow && substr($js,-1)==','){
                return substr($js, 0, -1);
            }

        }

        return $js;
    }

    /*
     * This method return json string after the creation
     */

    function getJsonString() {
        require_once('auto_loader.php');
        return '{'.$this->jsonstring.'}';
        //return $this->$jsonstring;
    }

}


?>
	






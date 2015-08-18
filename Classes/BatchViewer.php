<?php
/*
 * @author: Niroshan
 * 
 */

require_once('auto_loader.php');
/*
//example code
//This class can Show html from to show preview of the given json string
//$frame = new FrameGUI();
//$frame->echoHeader();


//example json string
$jsonstring = '{"Table":[{"EMP No": "1234","EPF No": "534","Name": "R.M.P.Jayaweera","Company": "LOMC","Department": "Finace","Corporate Title": "Employee","Dialog deductions": "1234.9"},{"EMP No": "1456","EPF No": "789","Name": "T.M.L.Ranga","Company": "LOLC","Department": "Loan","Corporate Title": "Employee","Dialog deductions": "456.9"},{"EMP No": "1235","EPF No": "123","Name": "N.M.P.Rathnayake","Company": "LOLC","Department": "Loan","Corporate Title": "Manager","Dialog deductions": "2345.8"}],"Comment": "This is a test batch","Author": ["JALP Jayakody","1234"],"Time": ["2015/01/02"]}';

//create object in BatchViewr Class
$batchviwer = new BatchViewer($jsonstring);

//echo table frame;
echo $batchviwer->getTableFrame();

*/
class BatchViewer {

    private $jsonstring;
    private $author;
    private $authorID;
    private $jsonobj;

    public function __construct($jsonstring) {
        //$jsonstring=strrev(substr(strrev($jsonstring), 1));
        //echo $jsonstring;
        $this->jsonstring = $jsonstring;
        $this->jsonobj = json_decode($jsonstring, true);
        //print_r($this->jsonobj);
        $this->author = $this->jsonobj["Author"][0];
        $this->authorID = $this->jsonobj["Author"][1];

    }

    /*
     * Get Table header
     */
    private function getTableFrameHeader() {
        $tableframestr= '<div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Preview</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group pull-right">
                                         <button data-toggle="dropdown" class="btn dropdown-toggle">Tools <span class="caret"></span></button>
                                         <ul class="dropdown-menu">
                                            <li><a href="#">Print</a></li>
                                            <li><a href="#">Save as PDF</a></li>
                                            <li><a href="#">Export to Excel</a></li>
                                         </ul>
                                      </div>
                                   </div>';
        return $tableframestr;
    }

    /*
     * Get Table content as HTML
     */
    private function getDetail() {
       $detailhtmlstr= '<table>
                    <thead>

                    </thead>
                            <tbody>
                                    <tr>
                                        <td width="45%">
                                            <i>Author :</i>
                                        </td>
                                        <td>
                                            <pre style="padding: 3px;">'.$this->author . '</pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i>User ID :</i>
                                        </td>
                                        <td>
                                           <pre style="padding: 3px;">'.$this->authorID . '</pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i>Date And Time :</i>
                                        </td>
                                        <td>
                                            <pre style="padding: 3px;">' . $this->getTime($this->jsonstring) . '</pre>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <i>Comment :</i>
                                        </td>
                                        <td>
                                            <pre style="padding: 3px;">' . $this->getComment($this->jsonstring) . '</pre></td>
                                        </td>
                                    </tr>
                            </tbody>
                            </table>';
        return $detailhtmlstr;
    }
/*
 * Get time by json string
 */
    private function getTime($jsonstring) {
        $obj = json_decode($jsonstring, true);
        return $obj["Time"][0];
    }
/*
 * Grt Batch comment by json string
 */
    private function getComment($jsonstring) {
        $obj = json_decode($jsonstring, true);
        return $obj["Comment"];
    }

    private function getTableFooter() {
        return '

            </div>
        </div>';
    }

    /*
     * REturn table frame
     */
    public function getTableFrame() {
        $tableframe=$this->getTableFrameHeader();
        $htonobj = new HTON();
        //echo json_encode($this->jsonobj["Table"]);
        $htonobj->getEditJson('{"Table":' . json_encode($this->jsonobj["Table"]) . '}');
        $tabledetail=$this->getDetail();
        $tablefooter=$this->getTableFooter();
        return $tableframe.$tabledetail.$tablefooter;
    }

}

?>

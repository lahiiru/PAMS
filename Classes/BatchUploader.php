<?php
/*
 * @author: Lahiru
 * @modified:
 *      Niroshan    -   designed the class
 * 
 */
//require_once './../checklogin.php';
//require_once 'XlsJSONParser.php';

require_once 'auto_loader.php';
/*
    //This class create updated json string for given xls file path
    //updated json string mean it include file created author information such as empid, name ,createdtime
    //that json string is return in createPreviewJson() method

    //example object creation
    $batchuploader=new BatchUploader('Dialog Deduction.xlsx');
    //call createPreviewJson() to return json string
    echo $batchuploader->createPreviewJson();
*/

class BatchUploader
{

    private $jsonparser;
    private $jsonstring;
    private $author;
    private $authoruserid;

    public function __construct($filepath)
    {
        //Finding users feeding code. E.g. "DLG"
        if (!isset($_SESSION))
        {
            session_start();
        }
        if (isset($_SESSION['currentRole']))
        {
            if(strpos($_SESSION['currentRole'], 'FD-')===FALSE){
                echo 'Permission denied! Please login as a Feeder';
                exit();
            }
            else{
                $feedCode=explode('-', $_SESSION['currentRole']);
                $feedCode=$feedCode[1];
            }
            
        }
        else{
            echo 'Current role not set.';
            exit();
        }

        $this->jsonparser=new XlsJSONParser($filepath,$feedCode);
        $this->jsonstring=$this->jsonparser->getJsonString();
        $this->author=$this->getAuthor();
        $this->authoruserid=$this->getAuthorID();



    }
    private function getUsersItemCode(){

        
    }
    private function getAuthor()
    {
        if (!isset($_SESSION))
        {
            session_start();
        }
        if (isset($_SESSION['empjson']))
        {
            $empjson=$_SESSION['empjson'];
            $obj=json_decode($empjson,true);
            return $obj[0]['name'];
        }
    }

    private function getAuthorID()
    {
        if (!isset($_SESSION))
        {
            session_start();
        }
        if (isset($_SESSION['empjson']))
        {
            $empjson=$_SESSION['empjson'];
            $obj=json_decode($empjson,true);
            return $obj[0]['empno'];
        }
    }



    public function  createPreviewJson()
    {
        $this->jsonstring=substr($this->jsonstring, 0, -1);
        $newJsonString = $this->jsonstring . ',"Comment":"' .'' . '","Author":["' . $this->author . '","'.$this->authoruserid.'"],'.'"Time":["'.date('Y-m-d h:i:s ', time()).'"]}';
        return $newJsonString;
    }

}

?>
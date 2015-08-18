<?php
/*
 * @author: Chanaka
 *  - creates GUI for the search tab
 *  - search values using different options
 *  - show the recult on a table
 *  - if there are no any record that searched then show alerts
 */


$fr = new FrameGUI();

//check for sumbit button clicked
if(isset($_POST["bsubmit"])){
    
    //check whether there is any value to search
    if(!empty($_POST["searchtext"])){
        $daAccess=new InquiryDA();
        $ht = new HTON();
     
        // check witch type has selected to search
        if($_POST["searchSelect"]=="Employee Number"){
            $data =$daAccess->searchByEmpNo($_POST["searchtext"]);
            if($data != null){
                $body=$ht->getVerticleTable($data);
                $alertText = '<div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong><br>
                    </div>';
                $fr->echoBlock('Search Result',echoTop($alertText).$body );
            }else{
                $alertText = '<div class="alert alert-info">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong>Info!</strong><br> No results found.
                    </div>';
                $fr->echoBlock('Search Result11',echoTop($alertText) );
            }
            
        }
        if($_POST["searchSelect"]=="Action Number"){
            $data =$daAccess->searchByActionNo($_POST["searchtext"]);
            if($data != null){
                $body=$ht->getVerticleTable($data);
                $alertText = '<div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong><br>
                    </div>';
                $fr->echoBlock('Search Result',echoTop($alertText).$body );
            }else{
                    $alertText = '<div class="alert alert-info">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Info!</strong><br> No results found.
                        </div>';
                    $fr->echoBlock('Search Result',echoTop($alertText) );
                }
        }
        if($_POST["searchSelect"]=="Item Number"){
            $data =$daAccess->searchByItemNo($_POST["searchtext"]);
            if($data != null){
                $body=$ht->getVerticleTable($data);
                $alertText = '<div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong><br>
                    </div>';
                $fr->echoBlock('Search Result',echoTop($alertText).$body );
            }else{
                    $alertText = '<div class="alert alert-info">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Info!</strong><br> No results found.
                        </div>';
                    $fr->echoBlock('Search Result',echoTop($alertText) );
                }
        }
        if($_POST["searchSelect"]=="Batch Number"){
            $data =$daAccess->searchByBatchNo($_POST["searchtext"]);
            if($data != null){
                $body=$ht->getVerticleTable($data);
                $alertText = '<div class="alert alert-success">
                        <button class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong><br>
                    </div>';
                $fr->echoBlock('Search Result',echoTop($alertText).$body );
            }else{
                    $alertText = '<div class="alert alert-info">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Info!</strong><br> No results found.
                        </div>';
                    $fr->echoBlock('Search Result',echoTop($alertText) );
                }
        }
 
        
    }else{
        $alertText = '<div class="alert">
                    <button class="close" data-dismiss="alert">&times;</button>
                    <strong>Warning!</strong><br> Invalid search.
                </div>';
        $fr->echoBlock('Search Result',echoTop($alertText));
    }
}else{
    
    $fr->echoBlock('Search', echoTop());
}




/*
 *  html code for search bar with option menu
 *  contains alerts
 */

function echoTop($alertText=''){
return '
        <div class="span12">
            <form class="form-horizontal"  method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>       
                        <select style="width:18%;" name="searchSelect">
                            <option>Action Number</option>
                            <option>Batch Number</option>
                            <option selected>Employee Number</option>
                            <option>Item Number</option>
                        </select>
                        <input type="text" style="width:62%;" name="searchtext">
                        <button type="submit" class="btn" name="bsubmit"><i class="icon-search icon-black"></i> Search</button> 
                    </legend>  
                    ' . $alertText . '
                </fieldset>
            </form> 
        </div>

';
}
?>
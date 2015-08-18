<?php
/*
 *  @author - Chanaka
 *         - this is the initial testing for advanced search and code is not "flexiblle".
 */
$fr = new FrameGUI();

$queryCondition = '';
if(isset($_POST["submit"])){
    if($_POST["searchselect"]=="Employee Details"){
        
//        $queryCondition .= getSelectedCompany();
//        if($queryCondition!==NULL){
//            echo ("SELECT `empno`,`epfno`,`name`,`company`,`itemtype` FROM `items` WHERE $queryCondition");
//        }
        if(isset($_POST["company"])){
            print_r($_POST["company"]);
            $ar=$_POST["company"];
            echo (count($ar));
        }
    }
}


function getSelectedCompany(){
    
}

$htmlcode= '
        <div class="span12">
        <form id="searchmainbody" class="form-horizontal"  method="post" enctype="multipart/form-data">
            <legend>Advanced Search</legend>
            <div class="control-group">
                <p><b>Search for</b></p>
                <div class="controls">
                    <select class="chzn-select chzn-done" style="width:25%;" id="searchSelect" name="searchselect">
                        <option>Action Details</option>
                        <option>Batch Details</option>
                        <option selected>Employee Details</option>
                        <option>Item Details</option>
                    </select> 
                </div> 
            <hr>  
            </div>
                       
            <div id ="iddiv" class="control-group">
                <p><b id="itemid">Enter Employee id</b></p>
                <div class="controls">
                    <input type="text" id="idinput">
                </div>
            <hr>
            </div>           
            
            <div id="companydiv" class="control-group">
                <p><b>Select company</b></p>
                <div class="controls">
                    <div class="form-horizontal">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="company[]" value="LOLC"/> LOLC
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LOMC"/> LOMC
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LOITS"/> LOITS
                            </label>                           
                            <label>
                                <input type="checkbox" name="company[]" value="LOFIN"/> LOFIN
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LOFAC"/> LOFAC
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LOMO"/> LOMO
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LSEC"/> LSEC
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LTEC"/> LTEC
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LOLS"/> LOLS
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LOLT"/> LOLT
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="CLC"/> CLC
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="BHR"/> BHR
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="LOINS"/> LOINS
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="BRAC"/> BRAC
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="EDEN S"/> EDEN S
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="EDEN Ex"/> EDEN Ex
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="Calm"/> Calm
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="Paradise"/> Paradise
                            </label>
                            <label>
                                <input type="checkbox" name="company[]" value="Dikwella"/> Dikwella
                            </label>
                            
                            
                        </div>                  
                    </div>
                </div>
                <hr>
            </div>
            
            
            <div id="itemdiv" class="control-group">
                <p><b>Select Item Type</b></p>
                <div class="controls">
                    <div class="form-horizontal">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="item[]" value="DLG"/> Dialog deduction (DLG)
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="FST"/> Festival advance (FST)
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="LNE"/> LOFIN execution (LNE)
                            </label>                           
                            <label>
                                <input type="checkbox" name="item[]" value="LNS"/> LOFIN settlement (LNS)
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="MDC"/> Medical (MDC)
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="MBT"/> Mobitel deduction (MBT)
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="RMT"/> new recruitment (RMT)	
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="NPY"/> No pay (NPY)
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="OVT"/> Over time (OVT)
                            </label>
                            <label>
                                <input type="checkbox" name="item[]" value="RSG"/> Resignation (RSG)
                            </label>
                            
                        </div>                  
                    </div>
                </div>
                <hr>
            </div>
            
            <div id="datediv" class="control-group">
                <div class="form-inline">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="searchbydate"/><b> Search by date</b>
                        </label>
                    </div>                  
                </div>
                <label class="control-label" for="startdate"> From </label>
                <div class="controls">
                    <input id="startdate" name="startdate" class="input-large datepicker help-inline" type="text"></input> 
                </div>
                <label class="control-label help-inline" for="enddate"> To </label>
                <div class="controls">
                    <input id="enddate" name="enddate" class="input-large datepicker" type="text"></input> 
                </div>
                <hr>
            </div>
            
            <div class="control-group">
                <button class="btn pull-right btn-primary" type="submit" name="submit">Search</button>
            </div>
         
        </form> 
    </div>

';
$fr->echoBlock('Search', $htmlcode);

?>


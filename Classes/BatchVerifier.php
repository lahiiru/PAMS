<?php
/*
 * This class have methods for verifying and showing related interfaces.
 * @author: Niroshan
 * @modified:
 * 
 */
require_once ('auto_loader.php');
/*
$batch=new BatchVerifier("LOLC","LOMC","CRE");
echo $batch->createContent();
*/

class BatchVerifier{
    private $postURL;
    private $company;
    private $itemtype;

    /*
     * For creation BatchVerifier Object want $postURL, $Company (LOMC/LOLC/...etc) and $itemtype (CRE,MOD,APR...etc)
     */

    public function __construct($postURL,$company,$itemtype){
        $this->company=$company;
        $this->itemtype=$itemtype;
        $this->postURL=$postURL;
    }

    /*
     * This method return pending item with approve button ,Reject button , add comment button
     */
    public function createContent($company,$itemtype){
        $empDetail = json_decode($_SESSION["empjson"], true);
        $empValues = $empDetail[0];
        $author = $empValues['username'];
        $authorID = $empValues['empno'];
        $HTMLTable=new HTON();
        $s=$HTMLTable->getSelectedItemItable("CRE",$company,$itemtype). '<p>
        <div class="pull-right">
            <button class="btn btn-danger" id="btnDelete">
                <i class="icon-remove icon-white"></i>
                Reject
            </button>
            <a id ="btnEdit" class="btn btn-primary" data-toggle="modal" >
                <i class="icon-edit icon-white"></i>
                Add Comment
            </a>

        </div>
        </p>
        <form action'.$this->postURL.' method = "POST" >
            <input type="hidden" id="author" value=' . $author . '></input>
            <input type="hidden" id="authorid" value=' . $authorID . '></input>
            <input type="hidden" id="hiddentxt" name="hiddentext" ></input>
            <p>
                <button class="btn " > Cancel </button>

                <button id="bSubmit" class="btn btn-primary" name="btnUpdate" >
                    <i class="icon-ok">

                    </i>Approve
                </button>
            </p>
        </form>

        <div id="editorModal" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h3 style="color:green">Update Record</h3>
            </div>
            <div class="modal-body" id="container">

            </div>
            <div class="modal-footer" id="footer">
                <button id="btnUpdate" class="btn btn-primary" data-dismiss="modal" >
                    <i class="icon-refresh icon-white">
                    </i> Update
                </button>
            </div>
        </div>

        <div id="infoModal" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 style="color:blue">! please select a row.</h4>
            </div>
        </div>
        ';
        return $s;
    }
}
?>
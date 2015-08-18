
<?php
/*
 * @author: Chanaka
 *        - this class will creates the editors window for batches ( with CRUD )
 * 
 * @modified:
 *      Lahiru  -   added try block for getEditor() method
 */
require_once ('auto_loader.php');

class BatchEditor {
    /*
     * $jOldString stores the json string before do any changes
     * $itemTag stores the item tag of the current details
     * $postURL stores the url where to post the result
     * $result stores html code for editors view
     * 
     */
    private $jOldString;
    private $itemTag;
    private $postURL;
    private $result;

    public function __construct($oldJsonString, $postURL) {
        $this->jOldString = $oldJsonString;
        $this->postURL = $postURL;
        $indexArray = array_keys(json_decode($this->jOldString, true));
        $this->itemTag = $indexArray[0];
    }

    public function getEditor() {
        try {
            $hton = new HTON();
            $this->result = $hton->getEditJson($this->jOldString);
            $this->createContent();
            return $this->result;
        } catch (Exception $e) {
            return "Error occured. Please try again.<br>".$e->getMessage();
        }
    }

    
    /*
     *  creates the html code for editor window and return
     */
    private function createContent() {
        
        /*
         * get the current users details to identify the who is the editor
         *     - user name
         *     - user employee number
         *     (set these values to hidden texts)
         */
        
        $empDetail = json_decode($_SESSION["empjson"], true);
        $empValues = $empDetail[0];
        $author = $empValues['username'];
        $authorID = $empValues['empno'];
        
        /*
         *  html code contains cuple of buttons and codes modal window
         *  there are three hidden text fiedls
         *      (1) - store user name
         *      (2) - store user employee number
         *      (3) - updated json string after do changes
         * 
         */
        $this->result = $this->result . '
        
        <div class="pull-right">
            
            <button class="btn btn-danger" id="btnDelete">
                <i class="icon-remove icon-white"></i>
                Delete
            </button>
            <a id ="btnEdit" class="btn btn-primary" data-toggle="modal" >  
                <i class="icon-edit icon-white"></i>
                Edit
            </a>
            <a id ="btnAddRow" class="btn btn-success" data-toggle="modal" >
                <i class="icon-plus icon-white"></i>
                Add New
            </a>
            
        </div>
        
        <form action=' . $this->postURL . ' method = "POST" >
            <input type="hidden" id="author" value=' . $author . '></input>
            <input type="hidden" id="authorid" value=' . $authorID . '></input>    
            <input type="hidden" id="itemtag" value=' . $this->itemTag . '></input>
            <input type="hidden" id="hiddentxt" name="hiddentext" ></input>
            <input type="hidden" id="oldjson" name="oldjson" value=\'' . $this->jOldString . '\'></input>
            <p>
                <button class="btn " > Cancel </button> 

                <button id="bSubmit" class="btn btn-primary" name="btnUpdate" >
                    <i class="icon-refresh icon-white">

                    </i> Update
                </button> 
            </p>
        </form> 
        
        <div id="editorModal" class="modal hide">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h3 style="color:green">Update Record</h3>
            </div>
            <div class="modal-body">
                <div calss="vinputs" id="container" >
                
                </div>
            </div>
            <div class="modal-footer" id="footer">
                <button id="btnUpdateRecord" class="btn btn-primary">
                    <i class="icon-refresh icon-white">
                    </i> Update
                </button> 
            </div>
        </div>
        
        

        <div id="addNewModal" class="modal hide">
            
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h3 style="color:green">Add New Record</h3>
            </div>
            <div class="modal-body" >
                <div calss="vinputs" id="addNewContainer">
                
                </div>
            </div>
            <div class="modal-footer" id="footer">
                <button id="btnaddnew" class="btn btn-success" >
                    <i class="icon-plus icon-white">
                    </i> Add New
                </button> 
        </div>
            
        
        <div id="infoModal" class="modal hide">
            <div class="modal-header">
                 
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 style="color:#0033FF">! please select a record.</h4>
            </div>            
        </div>
        <script>
            
            attachValidator(\'#addNewContainer\');
            attachValidator(\'#container\');
        </script>
        
        ';
    }

}
?>

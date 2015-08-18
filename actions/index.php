
<?php
/*
 * @author: Lahiru
 * Landing page of Actions.
 * Each tab contains seperate code in seperate php files. Check $tabNames 
 * assoc array to know the names of files.
 * Note: If any php is including in to this parent file,
 * posting should follow following format to get recieved by the child php.
 * "index.php?tb=".basename(__FILE__, '.php'))
 */
require_once('auto_loader.php');

$frame = new FrameGUI();
$param = '
    <script src="../js/GetTableData.js"></script>
    <script src="../js/validator.js"></script>
    <script src="../js/SearchContentCreater.js">    
    </script>
    <script type="text/javascript" class="init">
            $(document).ready(function () {

                 var table = $(\'#datatable\').dataTable( {
                 "scrollX": true
             } );
             window.x=table;
                $(\'#bSubmit\').click( function() {
                 getData();
             } );
    
            $(\'#btnEdit\').click(function(){
               window.validatorDivID=\'#container\';
                viewEditor();
            });
    
            $(\'#btnUpdateRecord\').click(function(){
                updateField();
            });
            
            $(\'#datatable tbody\').on(\'click\', \'tr\', function () {
                if ($(this).hasClass(\'selected\')) {
                    $(this).removeClass(\'selected\');
                }
                else {
                    table.api().$(\'tr.selected\').removeClass(\'selected\');
                    $(this).addClass(\'selected\');
                }
            });
            
            $(\'#btnDelete\').click(function () {
                table.fnDeleteRow(\'.selected\');
            });
            
 
            $(\'#btnAddRow\').on( \'click\', function () {
                window.validatorDivID=\'#addNewContainer\';
                addNew();
            } );
            
            $(\'#btnaddnew\').on( \'click\', function () {
                addField();
            } );
            
                    
        $(\'#searchSelect\').change(function(){
            createContent(this.value);
        
        });
        
        $(document).ready(function(){
            createContent("Employee Details");
        });
            
    // Automatically add a first row of data
                  

        });


    </script>
    <style>

        .col-lg-3 input{
            border:none;
            background:transparent;
            box-shadow:none;
        }
        .col-lg-3 input:focus{
            border:1px solid #ccc;
            background:#ffffff;
            border-color:rgba(82,168,236,0.8);
            -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
            -moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
            box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
        }
            th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 900px;
        margin: 0 auto;
    }
    </style>   
';
$frame->echoHeader(3, "Actions", $param);
$tab = 'Inquiry';                           //Landing tab
$tabNames = array('Inquiry','Search','Permissions');
if(explode('-', $_SESSION['currentRole'])[0]=='FD'){
    array_push($tabNames, 'Upload');
}else if(explode('-', $_SESSION['currentRole'])[0]=='HP'){
    array_push($tabNames, 'Approve');
}

if (isset($_GET['tb'])) {
    $tab = strtolower($_GET['tb']);
}

echo '<ul class="nav nav-tabs">';
foreach ($tabNames as $name) {
    if (strtolower($tab) == strtolower($name)) {
        $active = "active";
    } else {
        $active = "";
    }

    echo "<li role=\"presentation\"  class=\"$active\"><a onClick=\"document.location='" . basename($_SERVER['PHP_SELF']) . "?tb=" . strtolower($name) . "'\" href=\"#\">$name</a></li>";
}
echo '</ul>';

include_once strtolower($tab) . '.php';

$frame->echoFooter();
?>
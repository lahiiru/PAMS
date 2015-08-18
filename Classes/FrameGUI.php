<?php
/*
 * @author: Lahiru
 * Default frame of APAS including menues, HTML headers and scripts.
 */

/*
  //if $number=1   select notification
  //if $number=2   select  History
  //if $number=3  select  Actions
  //if $number=4  Profile Setting

  //create GUI frame
  $gui=new frameGUI();
  $gui->echoFrameGUI(2); //activates History tab

*/

require_once('auto_loader.php');
class FrameGUI {

    var $title;
    var $this;
    public function __construct() {
        $this->root='/Dropbox/';
    }

    public function echoHeader($number = 1, $title = "PAMS Home",$hparam="") {
        if (!isset($_SESSION)) {
            session_start();
        }
        $alert = '';
        $rm = new RolesManager($_SESSION['myusername']);
        if (isset($_GET['cr'])) {
            if (!isset($_SESSION['currentRole'])) {
                //this alert shows when CR is posted with login
                $alert='<div class="row-fluid">
                        <div class="alert alert-info">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                               <h4>Info!</h4>
                                   You are acting as ' . $rm->getRoleName($_GET['cr']) . '
                       </div>
                       </div>';
            } else if ($_SESSION['currentRole'] != $_GET['cr']) {
                $alert='<div class="row-fluid">
                        <div class="alert alert-success">
                           <button type="button" class="close" data-dismiss="alert">&times;</button>
                               <h4>Success</h4>
                                   Your role was succesfully changed to ' . $rm->getRoleName($_GET['cr']) . '
                       </div>
                       </div>';
            }
            $_SESSION['currentRole'] = $_GET['cr'];
        }

        $number = $number;
        $activestring1 = '';
        $activestring2 = '';
        $activestring3 = '';
        $activestring4 = '';

        $this->title = $title;


        if (!isset($_SESSION['currentRole'])) {
            $_SESSION['currentRole'] = 'EM';
        }
        if ($number == 1) {
            $activestring1 = 'class="active"';
        } else if ($number == 2) {
            $activestring2 = 'class="active"';
        } else if ($number == 3) {
            $activestring3 = 'class="active"';
        } else if ($number == 4) {
            $activestring4 = 'class="active"';
        }
        $switchRolesPostString = '?cr=';
        if ($rm->getRoleCode() != $_SESSION['currentRole']) {
            $switchRolesString = $rm->getRoleName($rm->getRoleCode());
            $switchRolesPostString.=$rm->getRoleCode();
        } else if ($rm->getRoleCode() == "EM") {
            $switchRolesString = "";
        } else {
            $switchRolesString = $rm->getRoleName("EM");
            $switchRolesPostString.="EM";
        }

        $currentRolesString = $rm->getRoleName($_SESSION['currentRole']);
        $json=$_SESSION['empjson'];
        $empdata=json_decode($json, true)[0];
        $userString = $_SESSION['myusername'] .' ('.$empdata['empno']. '), Acting as ' . $currentRolesString;
        $switcher = '';
        if ($switchRolesString != "") {
            $switcher = '<li>
                       <a tabindex="-1" href="' . basename($_SERVER['PHP_SELF']) . $switchRolesPostString . '"> Act as ' . $switchRolesString . '</a>
                       </li>';
        }
        
        $echostring = '
    <!DOCTYPE html>
<html class="no-js">
    
    <head>
    
        <title>'.$title.'</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Bootstrap -->
        <link href="'.$this->root.'bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="'.$this->root.'bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link rel="SHORTCUT ICON" href="'.$this->root.'images/pams.png"/>
        <!--<link href="'.$this->root.'vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">-->
        <link href="'.$this->root.'assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="'.$this->root.'vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
            <script src="'.$this->root.'vendors/jquery-1.9.1.js"></script>
                <script src="'.$this->root.'vendors/datatables/js/jquery.js"></script>
                <script src="'.$this->root.'vendors/datatables/js/jquery.dataTables.js"></script>
                <script src="'.$this->root.'vendors/chosen.jquery.min.js"></script>
		<link href="'.$this->root.'vendors/uniform.default.css" rel="stylesheet">
                <link href="'.$this->root.'vendors/chosen.min.css" rel="stylesheet">
                <link href="'.$this->root.'vendors/datepicker.css" rel="stylesheet">
                <link href="'.$this->root.'vendors/datatables/css/jquery.dataTables.css" rel="stylesheet">
                <link href="'.$this->root.'assets/DT_bootstrap.css" rel="stylesheet" media="screen">
		<!--<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">-->
			 
		<!-- Javascript -->
		<script type=\'text/javascript\' src="'.$this->root.'assets/js/modernizr.min.js"></script>
		<script type=\'text/javascript\' src="'.$this->root.'assets/js/css3-mediaqueries.js"></script>  
		 
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	
		  <script type=\'text/javascript\' src="'.$this->root.'assets/js/html5.js"></script>
		  <script type=\'text/javascript\' src="'.$this->root.'assets/js/respond.js"></script>

'.$hparam.'
    </head>
    
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="'.$this->root.'home.php">Home</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> ' . $userString . ' <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Profile</a>
                                    </li>
                                    <li class="divider"></li>
                                    ' . $switcher . '
                                    <li>
                                        <a tabindex="-1" href="'.$this->root.'logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Settings <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <li>
                                        <a href="#">Tools <i class="icon-arrow-right"></i>

                                        </a>
                                        <ul class="dropdown-menu sub-menu">
                                            <li>
                                                <a href="#">Reports</a>
                                            </li>
                                            <li>
                                                <a href="#">Logs</a>
                                            </li>
                                            <li>
                                                <a href="#">Errors</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">SEO Settings</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Other Link</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Content <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">Blog</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">News</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Custom Pages</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Calendar</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a tabindex="-1" href="#">FAQ</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Users <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="#">User List</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Search</a>
                                    </li>
                                    <li>
                                        <a tabindex="-1" href="#">Permissions</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                    	<li ' . $activestring1 . '>
                            <a href="#" onClick="document.location=\''.$this->root.'home.php\'"><span class="badge badge-success pull-right">2</span> Home</a>
                        </li>
                        <li ' . $activestring2 . '>
                            <a href="#" onClick="document.location=\''.$this->root.'history.php\'"><i class="icon-chevron-right"></i> History</a>
                        </li>
                        <li ' . $activestring3 . '>
                            <a href="#" onClick="document.location=\''.$this->root.'actions/index.php\'"><i class="icon-chevron-right"></i> Actions</a>
                        </li>
                        <li ' . $activestring4 . '>
                            <a href="#" onClick="document.location=\''.$this->root.'profile.php\'"><i class="icon-chevron-right"></i> Profile Settings</a>
                        </li>                       
                    </ul>
                </div>
                
                <!--/span-->
                <div class="span9" id="content">
                   ' . $alert . '
                ';

        echo $echostring;
    }

    public function echoFooter() {

        echo '  </div></div>
                    <hr>
                    <footer>
                        <p>2015 &copy; <i>own</i><b>IDEA<i>s</i></b> developer team.</p>
                    </footer>
                </div>
                <!--/.fluid-container-->
               



       
        <script src="'.$this->root.'bootstrap/js/bootstrap.min.js"></script>
        <script src="'.$this->root.'vendors/jquery.uniform.min.js"></script>
        
        <script src="'.$this->root.'vendors/bootstrap-datepicker.js"></script>
        
	<script src="'.$this->root.'assets/DT_bootstrap.js"></script>
        <script src="'.$this->root.'vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="'.$this->root.'vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="'.$this->root.'vendors/wizard/jquery.bootstrap.wizard.min.js"></script>

	<script type="text/javascript" src="'.$this->root.'vendors/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="'.$this->root.'assets/form-validation.js"></script>
        
	<script src="'.$this->root.'assets/scripts.js"></script>
           <script>

	jQuery(document).ready(function() {   
	   FormValidation.init();
	});

        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $(\'.textarea\').wysihtml5();

            $(\'#rootwizard\').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find(\'li\').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $(\'#rootwizard\').find(\'.bar\').css({width:$percent+\'%\'});
                // If it\'s the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $(\'#rootwizard\').find(\'.pager .next\').hide();
                    $(\'#rootwizard\').find(\'.pager .finish\').show();
                    $(\'#rootwizard\').find(\'.pager .finish\').removeClass(\'disabled\');
                } else {
                    $(\'#rootwizard\').find(\'.pager .next\').show();
                    $(\'#rootwizard\').find(\'.pager .finish\').hide();
                }
            }});
            $(\'#rootwizard .finish\').click(function() {
                alert(\'Finished!, Starting over!\');
                $(\'#rootwizard\').find("a[href*=\'tab1\']").trigger(\'click\');
            });
        });
        </script>             
            </body>
            </html>';
    }

    public function echoConstruction($errorDescription="Sorry for the inconvenience.") {

        echo
                '
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">'.$errorDescription.'</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12 pagination-centered">
                            <img src="'.$this->root.'/images/uc.png" class="col-md-3 img-responsive center" >
                        </div>
                    </div>
                </div>     
                ';
    }
    public function echoBlock($title,$body) {

        echo
                '
                <div class="block">
                    <div class="navbar navbar-inner block-header">
                        <div class="muted pull-left">'.$title.'</div>
                    </div>
                    <div class="block-content collapse in">
                        <div class="span12">
                            '.$body.' 
                        </div>
                    </div>
                </div>     
                ';
    }

}

?>

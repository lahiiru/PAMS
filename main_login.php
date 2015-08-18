<?php
/*
 *  @author: Lahiru
 *  Main login page acts three roles.
 *        .---------------------------------------------------------------------------------------------------------------------------.
 *        | GET variable	|	Page					|	Description																	|
 *        |---------------+---------------------------+-------------------------------------------------------------------------------|
 *        | <none>		|	Default login page 		|	User directly comes to the page												|
 *        | invalid		|	Invalid login page 		|	User is given another chance to enter login details when login was invalid	|
 *        | return		|	Login first page   		|	User tried to access inner content without signing in.						|
 *        | logout	X	|	Already logged in page          |	User tries to login when already there is a valid session.					|
 *        '---------------------------------------------------------------------------------------------------------------------------'
 *  This class should not use any php classes.
 *  @modified:
 */
session_start();
$txtD = '
	<form class="form-signin" method="post" action="checklogin.php" autocomplete="off">
	<h2 class="form-signin-heading">Please sign in</h2>
	<input autocomplete="off" name="myusername" id="myusername" type="text" class="input-block-level" placeholder="User name">
	<input name="mypassword" id="mypassword" type="password" class="input-block-level" placeholder="Password">
	<label class="checkbox">
		<input type="checkbox" value="remember-me"> Remember me
	</label>
	<button class="btn btn-large btn-primary" type="submit">Sign in</button>
	</form>
';
$txtI = '
		<form class="form-signin" method="post" action="checklogin.php" autocomplete="off">
			<div class="alert alert-error">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong><br> Invalid user name or password.
	</div>
	<h2 class="form-signin-heading">Please sign in</h2>
	<input autocomplete="off" name="myusername" id="myusername" type="text" class="input-block-level" placeholder="User name">
	<input name="mypassword" id="mypassword" type="password" class="input-block-level" placeholder="Password">
	<label class="checkbox">
		<input type="checkbox" value="remember-me"> Remember me
	</label>
	<button class="btn btn-large btn-primary" type="submit">Sign in</button>
	</form>
';
$txtL = '
	<form class="form-signin" method="post" action="#" onsubmit="return false;" autocomplete="off">
	<h2 class="form-signin-heading">Already logged in</h2><br>
	<p style="margin:5px 10px 10px;">You have already signed in as,</p>
	<p style="text-align: center;"><i class="icon-user"></i> ' . @$_SESSION['myusername'] . '</p>
	<p style="margin:5px 10px 10px;">Please sign out first if you want to log in as another user.</p><br>
	<center>
        <button class="btn" type="button" onClick="document.location=\'home.php\'">Go Home</button>
	<button class="btn btn-medium btn-warning" type="button" onClick="document.location=\'logout.php\'">Sign out</button>
	</center>
	</form>
';
if(isset($_GET['url'])){
    $redirect=$_GET['url'];
    
}
else{
    $redirect="home.php";
}
$txtA = '
	<form class="form-signin" method="post" action="checklogin.php?url='.$redirect.'" autocomplete="off">
	<div class="alert alert-info">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Info!</strong><br> You should be logged in first.
	</div>
	<h2 class="form-signin-heading">Please sign in</h2>
	<input autocomplete="off" name="myusername" id="myusername" type="text" class="input-block-level" placeholder="User name">
	<input name="mypassword" id="mypassword" type="password" class="input-block-level" placeholder="Password">
	<label class="checkbox">
		<input type="checkbox" value="remember-me"> Remember me
	</label>
	<button class="btn btn-large btn-primary" type="submit">Sign in</button>
	</form>
';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>APAS Login</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
			 
			 
		<!-- Javascript -->
		<script type='text/javascript' src="assets/js/modernizr.min.js"></script>
		<script type='text/javascript' src="assets/js/css3-mediaqueries.js"></script>  
		 
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	
		  <script type='text/javascript' src="assets/js/html5.js"></script>
		  <script type='text/javascript' src="assets/js/respond.js"></script>
    </head>
    <body id="login">
        <div class="container">


            <?php
            if (isset($_GET['invalid'])) {
                echo $txtI;
            } else if (isset($_GET['return'])) {
                echo $txtA;
            } else if (isset($_GET['logout'])) {
                echo $txtL;
            } else {
                echo $txtD;
            }
            ?>


        </div> <!-- /container -->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
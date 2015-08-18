<!--
        This page check whether there is an active session.
        And prompt for user if no session registered. (then it will redirect to requested page.)
        Continue to end if there is a valid session.
-->
<?php
require_once('auto_loader.php');

function login() {
    $host = "localhost"; // Host name 
    $username = "root"; // Mysql username 
    $password = ""; // Mysql password 
    $db_name = "users"; // Database name 
    $tbl_name = "members"; // Table name 
    // Connect to server and select databse.
    $con = mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect");
    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    // username and password sent from form 
    $myusername = $_POST['myusername'];
    $mypassword = $_POST['mypassword'];

    // To protect MySQL injection (more detail about MySQL injection)
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysqli_real_escape_string($con, $myusername);
    $mypassword = mysqli_real_escape_string($con, $mypassword);
    $sql = "SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
    $result = mysqli_query($con, $sql);

    // Mysql_num_row is counting table row
    $count = mysqli_num_rows($result);
    // If result matched $myusername and $mypassword, table row must be 1 row
    if ($count == 1) {
        // Register $myusername, $mypassword and redirect to file "login_success.php"
        $_SESSION['myusername'] = "$myusername";
        $redirect = @$_GET['url'];
        if ($redirect == "checklogin.php" || $redirect == "") {
            $redirect = "home.php";
        }
        //setting session variables
        getUserDetails($myusername);
        header("location:" . $redirect);
        //CONTINUE TO REST OF PAGE
        //LOGGED IN JUST NOW
    } else {
        echo header("location:main_login.php?invalid=");
    }
}

if (!isset($_SESSION)) {
    session_start();
}

$isPosting = isset($_POST['myusername']);
$isLoggedin = isset($_SESSION['myusername']);

if ($isLoggedin && $isPosting) {
    //session_destroy();
    //session_start();
    //login();
    echo header("location:main_login.php?logout=");
} else if ($isLoggedin && !$isPosting) {
    //LOGGED IN FAR BEFORE
    //CONTINUE TO REST OF PAGE
} else if (!$isLoggedin && $isPosting) {
    login();
} else {
    echo header("location:main_login.php?return=&url=" . basename($_SERVER['PHP_SELF']));
}

function getUserDetails($myusername) {
    $host = "localhost"; // Host name 
    $username = "root"; // Mysql username 
    $password = ""; // Mysql password 
    $db_name = "project"; // Database name 
    $tbl_name = "empdetail"; // Table name 
    $rm = new RolesManager($_SESSION['myusername']);
    $t = $rm->getRoleCode();
    $con = mysqli_connect("$host", "$username", "$password", "$db_name")or die("cannot connect");
    // Check connection  

    mysqli_select_db($con, $db_name);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "select * from `users`.`members` u join `project`.`empdetail` s on u.empno = s.empno where u.username='$myusername'";
    $result = mysqli_query($con, $sql);
    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    $json = json_encode($rows);
    $_SESSION['empjson'] = $json;

}


?>
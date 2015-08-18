<?php
/*
 * @author: Lahiru
 * Perform logout and return to login page
 */
session_start();
session_destroy();
echo header("location:main_login.php");
?>
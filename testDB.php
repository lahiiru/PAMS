<?php
require_once('auto_loader.php');
// 
//$fr = new FrameGUI();
//
//$param='<style>
//   .col-lg-3 input{
//   border:none;
//   background:transparent;
//   box-shadow:none;
//   }
//   .col-lg-3 input:focus{
//   border:1px solid #ccc;
//   background:#ffffff;
//   border-color:rgba(82,168,236,0.8);
//   -webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
//   -moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
//   box-shadow:inset 0 1px 1px rgba(0,0,0,0.075),0 0 8px rgba(82,168,236,0.6);
//   }
//</style>';
//$fr->echoHeader(3,"Test",$param);
//
// 
//$fr->echoFooter();

$da=new requestDA("CRE","LOMC");
print_r($da->getItem("itemdlg"));

?>

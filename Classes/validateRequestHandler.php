<?php
/*
 * @author: Lahiru
 * Recieves an user's input and replys with error message
 * should be posted to this file with ?value='User message'&title='Emp no'&objId='req tracking id'
 */
require_once('auto_loader.php');

if(isset($_POST['value']) && isset($_POST['title']) && isset($_POST['objId'])){
    $vc=new FieldValidator(urldecode($_REQUEST['title']),  urldecode($_REQUEST['value']));
    echo $_POST['objId'].':'.$vc->getError();
}
else{
    echo 'Bad request:';
}
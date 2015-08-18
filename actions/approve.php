<?php
/*
 * @author: Lahiru
 */

/*
require_once ('auto_loader.php');
$batch=new BatchVerifier("LOLC","LOMC","CRE");
$body=$batch->createContent();

$frame = new FrameGUI();
$frame->echoBlock("", $body);
*/
require_once('auto_loader.php');
$frame = new FrameGUI();
$cont = getApproveBody();
$title = "";
$uploadedFile = "";
if (!isset($_SESSION)) {
    session_start();
}


if (isset($_POST["hiddentext"]) && isset($_POST["btnUpdate"])) {                // Clicking submit button of BatchEditor
    if (isset($_SESSION['u01'])) {                                              // If resubmitting page just after batch uploading
        $alertText = '<div class="alert">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Info!</strong><br> It seems you are uploading a duplicate copy.
            </div>';
    } else {                                                                    // Normal submission of edited batch
        $update=new UploaderDA($_POST["hiddentext"]);
        $message1=$update->upload();

        $alertText = '<div class="alert ' . $message1[0] . '">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Info!</strong><br> ' . $message1[1] . '
            </div>';
        $_SESSION['u01'] = '';                                                  //resubmission prevent flag
    }
    $cont = getApproveBody($alertText);
    $title = "Step 1/2";
}
else if (isset($_POST["dlg"])) {                                           // Clicking submit button of file uploader form
        $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","DLG");

}

else if (isset($_POST["mbt"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","MBT");

}

else if (isset($_POST["fst"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","FST");

}

else if (isset($_POST["lne"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","LNE");

}

else if (isset($_POST["LNS"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","LNS");

}

else if (isset($_POST["mdc"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","MDC");

}

else if (isset($_POST["rmt"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","RMT");

}

else if (isset($_POST["npy"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","NPY");

}

else if (isset($_POST["ovt"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","OVT");

}

else if (isset($_POST["rsg"])) {                                           // Clicking submit button of file uploader form
    $batchverify=new BatchVerifier("index.php?tb=" . basename(__FILE__),"LOMC","CRE");
    $cont=$batchverify->createContent("LOMC","RSG");

}

$frame->echoBlock($title, $cont);

function getApproveBody($alertText = '') {
    $requestDA=new RequestDA("CRE","LOMC");
    $notificationNum=$requestDA->getCountNotifiaction();
    $buttonform='<form class="form-horizontal"  method="post" enctype="multipart/form-data">
                <fieldset>';
    foreach ($notificationNum as $key=>$number){
        $buttonform.='<button type="submit" name="'.strtolower($key).'" class="btn" >'.$key.'  Item<span class="badge badge-success pull-right" size="50px">'.$number.'</span></button>';
    }
    $buttonform.='</fieldset>
              </form>';


    return $buttonform;
}


function showTable($table) {




}
?>
<?php
/*
 * @author: Lahiru
 * this page does not reqired html tags, FramGUI headers or footers.
 * this will be only a content in another page.
 * this page will be included in index.php
 */
//require_once('auto_loader.php');
$frame = new FrameGUI();
$cont = getUploaderBody();
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
        $update = new UploaderDA($_POST["hiddentext"]);
        $message1 = $update->upload();

        $alertText = '<div class="alert ' . $message1[0] . '">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Info!</strong><br> ' . $message1[1] . '
            </div>';
        $_SESSION['u01'] = '';                                                  //resubmission prevent flag
    }

    $cont = getUploaderBody($alertText);
    $title = "Step 1/2";
} else if (isset($_POST["submit"])) {                                           // Clicking submit button of file uploader form
    unset($_SESSION['u01']);                                                    //resubmission prevent flag
    $error = uploadFile();                                                      // sets $uploadFile variable if correctly uploaded.
    if ($error == "") {                                                         // No error in uploaded file. successfully copied to local 
        if ($uploadedFile != '') {
            $batchUploader = new BatchUploader($uploadedFile);
        } else {
            $cont = getUploaderBody();
            $title = "Step 1/2";
        }
        $JSONString = $batchUploader->createPreviewJson();
        if ($JSONString != '') {
            $be = new BatchEditor($JSONString, "index.php?tb=" . basename(__FILE__, '.php'));
            $cont = $be->getEditor();
            $title = "Step 2/2";
        } else {
            $cont = getUploaderBody();
            $title = "Step 1/2";
        }
        if (file_exists($uploadedFile)) {
            unlink($uploadedFile);
        }
        $uploadedFile = '';
    } else {                                                                    // Error occured while copying the file to local server.
        $alertText = '
        <div class="alert alert-error">
		<button class="close" data-dismiss="alert">&times;</button>
		<strong>Error!</strong><br>' . $error . '
	</div>';
        $cont = getUploaderBody($alertText);
        $title = "Step 1/2";
    }
} else {                                                                        // Normal landing
    $cont = getUploaderBody();
    $title = "Step 1/2";
}

$frame->echoBlock($title, $cont);

function getUploaderBody($alertText = '') {                                     // default step 1/2
    return '<form class="form-horizontal"  method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Upload an annexure</legend>
                    ' . $alertText . '
                    <div class="control-group">
                        <label class="control-label" for="fileInput">Excel workbook</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" name="fileToUpload" id="fileToUpload" type="file">
                                          </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                        <button type="reset" class="btn">Cancel</button>
                    </div>
                </fieldset>
            </form>';
}

function uploadFile() {
    $target_dir = "file_cache/";
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if ($fileName == "") {
        return "No file selected.";
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        //return "Please try again, file cache conflict with your file.";
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        return "Sorry, your file is too large.";
    }
    // Allow certain file formats
    if ($imageFileType != "xls" && $imageFileType != "xlsx") {
        return "Sorry, only XLS and XLSX files are allowed.";
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        return "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . time() . $_SESSION['myusername'] . '.' . $imageFileType)) {
            global $uploadedFile;
            $uploadedFile = $target_dir . time() . $_SESSION['myusername'] . '.' . $imageFileType;
            return ""; //"The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }
}
?>
<html>

</html>
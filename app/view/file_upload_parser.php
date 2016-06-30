<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 30/06/2016
 * Time: 09:22
 */

$fileName = $_FILES["file1"]["name"];
$fileTmpLoc = $_FILES["file1"]["tmp_name"];
$fileType = $_FILES["file1"]["type"];
$fileSize = $_FILES["file1"]["size"];
$fileErrorMsg = $_FILES["file1"]["error"];


if (!$fileTmpLoc){
    echo "ERROR: please browse for a file before clicking the uload button.";
    exit();
}


if (move_uploaded_file($fileTmpLoc, "test_uploads/$fileName")){
    echo "$fileName upload is complete";
}else{
    echo "move_uploaded_file function failed";
}

?>

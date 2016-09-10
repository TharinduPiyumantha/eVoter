<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/27/2016
 * Time: 11:46 PM
 */

require_once("../model/DB_1.php");
require_once("../model/candidate.php");

$db = new DB_1();
$connection = $db->connectToDatabase();

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$target_path = "";

if (isset($_POST['submit'])) {
    $j = 0;     // Variable for indexing uploaded image.
    $target_path1 = "../../public/uploads/";     // Declaring Path for uploaded images.
    for ($i = 0; $i < count($_FILES['imgPath']['name']); $i++) { // Loop to get individual element from the array
        $validextensions = array("jpeg", "jpg", "png");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['imgPath']['name'][$i]));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        $target_path = $target_path1 . $_FILES['imgPath']['name'][$i];    // Set the target path with a new name of image.
        $j = $j + 1;      // Increment the number of uploaded images according to the files in array.
        if (($_FILES["imgPath"]["size"][$i] < 100000)     // Approx. 100kb files can be uploaded.
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['imgPath']['tmp_name'][$i], $target_path)) {
                //echo $_FILES['imgPath']['tmp_name'][$i].'<br>';
                // If file moved to uploads folder.
                //echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {     //  If File Was Not Moved.
                //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {     //   If File Size And File Type Was Incorrect.
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }

        //echo $target_path.'<br>';
        $memberID = $_POST["memberID"][$i];
        //echo $memberID.'<br>';
        $candNo = $_POST["candNo"][$i];
        //echo $candNo.'<br>';
        $fileName = $target_path;
        //echo $fileName.'<br>';
        //echo $electionID.'<br>';


        $candidate = new Candidate();
        $candidate->updateCandidate($connection,$candNo,$fileName,$electionID,$memberID);


    }
}
header("location: ../view/addVotersInterface.php?electID=".$electionID);

?>
<?php

/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/06/2016
 * Time: 12:55
 */

require_once '../model/dbConfig.php';

if($_POST){

    $img = "#";
    $status = "1";
    $fname		= filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
    $mid		= filter_var($_POST["mid"], FILTER_SANITIZE_STRING);
    $nic	= filter_var($_POST["nic"], FILTER_SANITIZE_STRING);
    $email		= filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $mobile	= filter_var($_POST["mobile"], FILTER_SANITIZE_STRING);
    $doj		= filter_var($_POST["doj"], FILTER_SANITIZE_STRING);
    $clubpost	= filter_var($_POST["clubpost"], FILTER_SANITIZE_STRING);
    $username	= filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $confirmpwd	= filter_var($_POST["confirmpwd"], FILTER_SANITIZE_STRING);


    $sql = "INSERT INTO clubmember (memberID,member_name,NIC,email,mobileNumber,clubPost,dateOfJoin,profileImage,status,username,password)
VALUES ('$mid','$fname','$nic','$email','$mobile','$clubpost','$doj','$img','$status','$username','$confirmpwd')";

    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>

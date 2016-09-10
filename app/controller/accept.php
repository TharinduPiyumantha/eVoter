<?php

/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/06/2016
 * Time: 12:55
 */

require_once '../model/dbConfig.php';
require_once("../model/sms.php");
require_once("../model/email.php");
require_once '../core/init.php';

$user_mid = $_GET['value'];
/*$user_email = $_GET['email'] ;
$user_mob = $row[4];*/
$pin=" ";

$message = "Hi Lion, Your account has been created successfully. Please log into the system with your username and password. Thank You and Have a nice day! :)";

$sql = "SELECT * FROM clubmember where memberID = '$user_mid'";
$result = mysqli_query($con, $sql);

while ($array = mysqli_fetch_row($result)) {
    $user_email = $array[3];
    $user_mob = $array[4];

    $sql1 = "UPDATE clubmember SET status= 'registered' WHERE memberID= '$user_mid'";
    $sql2 = "INSERT INTO securitypin (memberID,pin) VALUES ('$user_mid','$pin')";

    if ($con->query($sql1) === TRUE) {
        if ($con->query($sql2) === TRUE) {
            echo 'New record update successfully';
        }
    } else {
        echo 'Error: ' . $sql1 . '<br>' . $con->error;
    }

    $subject = "Welcome to eVoter";

    $sms = new SMS();
    $sms->sendSMS($message,$user_mob);
    $emailObj = new Email();
    $emailObj->sendMail($user_email, $subject, $message);
}
$con->close();
header("location: ../view/userRequests.php");
?>

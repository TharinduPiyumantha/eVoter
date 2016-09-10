<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 8/3/2016
 * Time: 12:11 PM
 */

require_once("../model/DB_1.php");
require_once("../model/member.php");
require_once("../model/election.php");
require_once("../model/sms.php");
require_once("../model/email.php");

$db = new DB_1();
$connection = $db->connectToDatabase();

$electionID="";
if(isset($_POST["electID"])){
    $electionID=$_POST["electID"];
}
$memberType="";
if(isset($_POST["memType"])){
    $memberType=$_POST["memType"];
}
$email="";
if(isset($_POST["emailAdd"])){
    $email=$_POST["emailAdd"];
}
$mobile="";
if(isset($_POST["mobileNo"])){
    $mobile=$_POST["mobileNo"];
}

$election = new Election();
$electDetails = $election-> getElectionDetails($connection,$electionID);
$row1= mysqli_fetch_row($electDetails);
$electName = $row1[0];
//echo $electName;
$date = $row1[1];
//echo $date;
$startTime = $row1[2];
//echo $startTime;
$endTime = $row1[3];
//echo $endTime;
$url = "https://lionsclub.Diyawannawa.com";

$message = "";
if($memberType == "voter") {
    $message = "Hi Lion, Message From Lions Club of Diyawannawa. The " . $electName . " election was scheduled to be held on " . $date . " from " . $startTime . " to " . $endTime . ". You have been selected as a privileged voter for the above election. Voting is highly important. Visit Our Website To View More Info. " . $url . " Thank You and Have a nice day! :)";
}else{
    $message = "Hi Lion, Message From Lions Club of Diyawannawa. The " . $electName . " election was scheduled to be held on " . $date . " from " . $startTime . " to " . $endTime . ". You have been selected as a privileged candidate for the above election. Participating is highly important. Visit Our Website To View More Info. " . $url . " Thank You and Have a nice day! :)";
}
$subject = $electName;

$sms = new SMS();
$sms->sendSMS($message,$mobile);
$emailObj = new Email();
$emailObj->sendMail($email, $subject, $message);

?>

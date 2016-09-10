<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 8/5/2016
 * Time: 10:46 PM
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
$memberID="";
if(isset($_POST["memType"])){
    $memberID=$_POST["memType"];
}
$comment="";
if(isset($_POST["commentSt"])){
    $comment=$_POST["commentSt"];
}
$membrID="";
if(isset($_POST["memID"])){
    $membrID=$_POST["memID"];
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

$member = new Member();
$emailAndMobile = $member->selectEmailAndMobile($connection, $membrID);
$row = mysqli_fetch_row($emailAndMobile);
$email = $row[0];
$mobile = $row[1];

$message = "";
if($memberID == "voter") {
    $message = "Hi Lion, Message From Lions Club of Diyawannawa. Your privillage of voting for the ". $electName ." election scheduled to be held on " . $date . " from " . $startTime . " to " . $endTime . " was cancelled due to ".$comment." Sorry for the incovenience. Thank You and Have a nice day! :)";
}else{
    $message = "Hi Lion, Message From Lions Club of Diyawannawa. You have removed from the position of the candidate of the " . $electName . " election which was scheduled to be held on " . $date . " from " . $startTime . " to " . $endTime . " due to ".$comment.". Sorry for the incovenience. Thank You and Have a nice day! :)";
}
$subject = $electName;

$sms = new SMS();
$sms->sendSMS($message,$mobile);
$emailObj = new Email();
$emailObj->sendMail($email, $subject, $message);

?>
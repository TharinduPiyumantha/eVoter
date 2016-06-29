<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/25/2016
 * Time: 6:59 AM
 */


require_once("../model/member.php");
require_once("../model/election.php");
require_once ("../model/DB_1.php");
require_once ("../model/email.php");
require_once ("../model/sms.php");

$db = new DB_1();
$connection = $db->connectToDatabase();

$electionID="";
if(isset($_POST["electID"])){
    $electionID=$_POST["electID"];
}
$memberID="";
if(isset($_POST["memberID"])){
    $memberID=$_POST["memberID"];
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

$message = "Message From Lions Club of Diyawannawa. Your elections privileges have been disabled for the ".$electName." election which was scheduled to be held on ".$date." from ".$startTime." to ".$endTime.". Sorry for the inconvenient. Thank You and Have a nice day! :)";
$subject = $electName;

$member = new Member();
$member ->deleteVoters($connection,$electionID,$memberID);

$emailAndMobile = $member->selectEmailAndMobile($connection,$memberID);
$row2 = mysqli_fetch_row($emailAndMobile);
$emailAddress = $row2[0];
$mobile = $row2[1];
$sms = new SMS();
//$sms->sendSMS($message,$mobile);

$email = new Email();
/*$email->sendMail($emailAddress,$subject,$message);*/

?>
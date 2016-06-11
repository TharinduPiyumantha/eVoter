<?php
require_once("../model/DB.php");
require_once("../model/member.php");
require_once("../model/election.php");
require_once("../model/sms.php");
require_once("../model/email.php");

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db = new Db();
$connection = $db->connectToDatabase();

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
$url = "http://2011-2012.306c1.com";

$message = "Hi Lion, Message From Lions Club of Diyawannawa. The ".$electName." election was scheduled to be held on ".$date." from ".$startTime." to ".$endTime.". You have been selected as a privileged voter for the above election. Voting is highly important. Visit Our Website To View More Info. ".$url." Thank You and Have a nice day! :)";
$subject = $electName;

$memberID = "";
if(!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $check) {
        $memberID = $check;
        $status1="to be voting";
        $member = new Member();
        $member->addMemberElectionDetails($connection,$memberID,$electionID,$status1);
    }
}
if(!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $check) {
        $memberID = $check;
        $member = new Member();
        $emailAndMobile = $member->selectEmailAndMobile($connection,$memberID);
        $row2 = mysqli_fetch_row($emailAndMobile);
        $emailAddress = $row2[0];
        $mobile = $row2[1];
        $sms = new SMS();
        $sms->sendSMS($message,$mobile);
        $pageName = "electionList.php";
        $email = new Email();
        $email->sendMail($emailAddress,$subject,$message,$pageName);

    }
}

?>
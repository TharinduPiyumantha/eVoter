<?php
require_once("../model/DB_1.php");
require_once("../model/member.php");
require_once("../model/election.php");
require_once("../model/sms.php");
require_once("../model/email.php");
require_once("../model/candidate.php");


$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db = new DB_1();
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

$message = "Hi Lion, Message From Lions Club of Diyawannawa. The ".$electName." election was scheduled to be held on ".$date." from ".$startTime." to ".$endTime.". You have been selected as a privileged voter and as a candidate for the above election. Voting is highly important. Visit Our Website To View More Info. ".$url." Thank You and Have a nice day! :)";
$subject = $electName;

$memberID = "";
if(!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $check) {
        $memberID = $check;
        echo $electionID;
        echo $memberID;

        $status1="to be voting";
        $candidate = new Candidate();
        $candidate->insertCandidateIntoDB($connection,$electionID,$memberID);
    }
}
if(!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $check) {
        $memberID = $check;
        $member = new Member();
        $emailAndMobile = $member->selectEmailAndMobile($connection, $memberID);
        $row2 = mysqli_fetch_row($emailAndMobile);
        $emailAddress = $row2[0];
        $mobile = $row2[1];
        $sms = new SMS();
        //$sms->sendSMS($message,$mobile);
        $pageName = "candidateList.php?electID=".$electionID;
        $email = new Email();
        $email->sendMail($emailAddress, $subject, $message, $pageName);

    }
}

?>
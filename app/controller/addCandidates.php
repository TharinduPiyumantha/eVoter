<?php
require_once("../model/DB_1.php");
require_once("../model/candidate.php");
require_once("../model/member.php");
require_once("../model/election.php");
require_once("../model/sms.php");


$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db = new DB_1();
$connection = $db->connectToDatabase();

$memberID = "";
if(!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $check) {
        $memberID = $check;
        echo $electionID;
        echo $memberID;

        $status1="to be voting";
        $candidate = new Candidate();
        $candidate->insertCandidateIntoDB($connection,$electionID,$memberID);
        $member = new Member();
        $member->changeStatusToCandidate($connection,$memberID);


    }
}
header("location: ../view/candidateList.php?electID=".$electionID);

?>
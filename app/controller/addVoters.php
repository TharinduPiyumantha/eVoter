<?php
require_once("../model/DB_1.php");
require_once("../model/member.php");

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
$status="";
if(isset($_GET["status"])){
    $status=$_GET["status"];
}
//echo $status;

$db = new DB_1();
$connection = $db->connectToDatabase();

$memberID = "";
if(!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $check) {
        $memberID = $check;
        $status1="to be voting";
        $member = new Member();
        $member->addMemberElectionDetails($connection,$memberID,$electionID,$status1);
    }
}
header("location: ../view/viewElectionDetails.php?electID=".$electionID."&status=".$status);
?>
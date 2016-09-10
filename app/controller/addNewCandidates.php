<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/28/2016
 * Time: 3:40 PM
 */


require_once("../model/DB_1.php");
require_once("../model/member.php");
require_once("../model/election.php");
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

$memberID = "";
if(!empty($_POST['check_list'])) {
    foreach ($_POST['check_list'] as $check) {
        $memberID = $check;
        echo $electionID;
        echo $memberID;
        $candidate = new Candidate();
        $candidate->insertCandidateIntoDB($connection,$electionID,$memberID);

        $sql = "update clubmember set status='candidate' where memberID='$memberID'";
        mysqli_query($connection,$sql);
    }
}
header("location: ../view/newCandidateList.php?electID=".$electionID);
?>
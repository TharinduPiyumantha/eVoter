<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/24/2016
 * Time: 5:18 AM
 */

require_once '../model/election.php';
require_once '../model/DB_1.php';

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
$electionName="";
if(isset($_POST["elecName"])){
    $electionName=$_POST["elecName"];
}
//echo $electionName;
$date="";
if(isset($_POST["date"])){
    $date=$_POST["date"];
}
//echo $date;
$startTime="";
if(isset($_POST["sTime"])){
    $startTime=$_POST["sTime"];
}
//echo $startTime;
$endTime="";
if(isset($_POST["eTime"])){
    $endTime=$_POST["eTime"];
}
//echo $endTime;
$noOfVotesPerPerson="";
if(isset($_POST["votes"])){
    $noOfVotesPerPerson=$_POST["votes"];
}
//echo $noOfVotesPerPerson;

$db = new DB_1();
$connection = $db->connectToDatabase();

if(!empty($electionName)&&!empty($date)&&!empty($startTime)&&!empty($endTime)&&!empty($noOfVotesPerPerson)) {
    $election = new Election();
    $election->updateElectionDetails($connection,$electionName,$date,$startTime,$endTime,$noOfVotesPerPerson,$electionID);
}
header("location: ../view/editCandidatesInterface.php?electID=".$electionID);

?>
<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/4/2016
 * Time: 1:05 PM
 */

require_once '../model/election.php';
require_once '../model/DB_1.php';

$electionName="";
if(isset($_POST["elecName"])){
    $electionName=$_POST["elecName"];
}
echo $electionName;
$date="";
if(isset($_POST["date"])){
    $date=$_POST["date"];
}
echo $date;
$startTime="";
if(isset($_POST["sTime"])){
    $startTime=$_POST["sTime"];
}
echo $startTime;
$endTime="";
if(isset($_POST["eTime"])){
    $endTime=$_POST["eTime"];
}
echo $endTime;
$noOfVotesPerPerson="";
if(isset($_POST["votes"])){
    $noOfVotesPerPerson=$_POST["votes"];
}
echo $noOfVotesPerPerson;

$db = new DB_1();
$connection = $db->connectToDatabase();
$elecID="";

if(!empty($electionName)&&!empty($date)&&!empty($startTime)&&!empty($endTime)&&!empty($noOfVotesPerPerson)) {
    $election = new Election($electionName,$date,$startTime,$endTime,$noOfVotesPerPerson);
    $election->insertIntoElection($connection);
    $elecID = $election->getMaxElectionID($connection);
}
header("location: ../view/addCandidatesInterface.php?electID=".$elecID);
?>
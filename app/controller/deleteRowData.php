<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/17/2016
 * Time: 5:30 PM
 */

require_once("../model/candidate.php");
require_once ("../model/DB_1.php");

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
$candi = new Candidate();
$candi->deleteCandidate($connection,$electionID,$memberID);

?>
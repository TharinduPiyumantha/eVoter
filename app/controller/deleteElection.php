<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/25/2016
 * Time: 4:35 PM
 */
require_once("../model/DB_1.php");
require_once("../model/election.php");

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$db = new DB_1();
$connection = $db->connectToDatabase();

$election = new Election();
$election->deleteElection($connection,$electionID);

header("location: ../view/electionList.php");

?>
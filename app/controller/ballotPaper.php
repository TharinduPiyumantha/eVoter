<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 8/1/2016
 * Time: 11:44 AM
 */

require_once("../model/ballotPaper.php");
require_once("../model/DB_1.php");
require_once '../core/init.php';

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$user = new User();
$userID = $user->data()->memberID;
$db = new DB_1();
$connect = $db->connectToDatabase();

$ballot = new BallotPaper();


if(!empty($_POST['vote'])) {
    foreach ($_POST['vote'] as $check) {
        $ballot->insertIntoBallotPaper($connect,$check,$electionID,$userID);
    }
}
header("location: ../view/home.php");

?>
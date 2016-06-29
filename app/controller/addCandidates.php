<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/4/2016
 * Time: 11:34 PM
 */
require_once("../model/candidate.php");
require_once("../model/DB_1.php");
require_once("../model/member.php");

$db = new DB();
$connection = $db->connectToDatabase();


$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}
$table = "clubmember";
$status = "candidate";
if(!empty($_POST['memberName'])&&!empty($_POST['memberID'])&&!empty($_POST['candNo']))
{

    foreach ($_POST['memberName'] as $key => $value)
    {
        $memberName = $_POST["memberName"][$key];
        $memberID = $_POST["memberID"][$key];
        $candNo = $_POST["candNo"][$key];
        $symbolImage = "aaaaaaaaaaaaaaa"; //just for now. need to be corrected
        //$browse = $_POST["browse"][$key];


        $candidate = new Candidate($electionID,$memberID,$candNo,$symbolImage);
        $candidate -> insertCandidateIntoDB($connection);
        $member = new Member();
        $member->changeMemStatus($connection,$status,$memberID);

    }
}

else{
    throw new Exception("Please fill all the required values");
}

header("location: ../view/addVotersInterface.php?electID=".$electionID);

?>
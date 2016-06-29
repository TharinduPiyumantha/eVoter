<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/4/2016
 * Time: 11:34 PM
 */
require_once("../model/candidate.php");
require_once ("../model/DB.php");
require_once("../model/member.php");

$db = new DB_1();
$connection = $db->connectToDatabase();


$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

if(!empty($_POST['memberName'])&&!empty($_POST['memberID'])&&!empty($_POST['candNo']))
{

    foreach ($_POST['memberName'] as $key => $value)
    {
        $memberName = $_POST["memberName"][$key];
        $memberID = $_POST["memberID"][$key];
        $candNo = $_POST["candNo"][$key];
        $symbolImage = "aaaaaaaaaaaaaaa"; //just for now. need to be corrected
        //$browse = $_POST["browse"][$key];


        $candidate = new Candidate();
        $candidate -> insertCandidateIntoDB($connection,$electionID,$memberID,$candNo,$symbolImage);
    }
}

else{
    throw new Exception("Please fill all the required values");
}

header("location: ../view/editVotersInterface.php?electID=".$electionID);

?>
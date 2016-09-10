<?php
require_once("../model/ballotPaper.php");
require_once("../model/DB_1.php");
require_once '../core/init.php';
require_once("../model/email.php");
require_once("../model/sms.php");

$electionID="";
if(isset($_GET["electID"])){
    $electionID=$_GET["electID"];
}

$user = new User();
$userID = $user->data()->memberID;
$userEmail = $user->data()->email;
$userMobile = $user->data()->mobileNumber;
$db = new DB_1();
$connect = $db->connectToDatabase();

$ballot = new BallotPaper();

$answerarray = array();
$qidarray = array();
if(!empty($_POST['answer'])) {
    foreach ($_POST['answer'] as $check) {
        array_push($answerarray,$check);

    }
}
if(!empty($_POST['qid'])) {
    foreach ($_POST['qid'] as $check1) {
        array_push($qidarray,$check1);

    }
}
$join = array();

foreach( $qidarray as $index => $code ) {
    $join[$code] = $answerarray[$index];

}
//print_r ($join);
$join1 = array();
$a = $ballot->getUserSecurityQuestions($connect,$userID);
while($data = $a->fetch_row()){
    $join1[$data[1]] = $data[2];
}


$result = array_diff($join1,$join);
//print_r($result);
$count=0;
$pin = substr(md5(uniqid(mt_rand(), true)),0,6);

$message = "Your security PIN number for the vote is : ".$pin;
$subject = "Evoter election";
$emailObject = new Email();
$sms = new SMS();
$attempts = $ballot->getUserSecurityPin($connect,$userID);
$attempts1 = $attempts->fetch_row();
$attempts2 = $attempts1[1];

if(sizeof($result)>0){
    /*alert*/
    $new_attempts = $attempts2+1;
    if($new_attempts==3){
        $x = 0;
        $ballot->updateAttempts($connect,$userID,$x);
        //header("location: ../view/memberHome.php");

    }
    else{
        $ballot->updateAttempts($connect,$userID,$new_attempts);
    }
    $temp = 3 - $new_attempts;
    header("location: ../view/ballotSecurityQuestions.php?electID=".$electionID."&attempts=".$temp);


}
else{
    $x = 0;
    $ballot->updateAttempts($connect,$userID,$x);
    $ballot->updateSecurityPin($connect,$userID,$pin);
    $emailObject->sendMail($userEmail,$subject,$message);
    $sms->sendSMS($message,$userMobile);
    header("location: ../view/ballotSecurityPin.php?electID=".$electionID);
}
?>
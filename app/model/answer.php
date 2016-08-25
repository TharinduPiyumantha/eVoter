<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 01/08/2016
 * Time: 22:43
 */

require_once 'dbConfig.php';
require_once '../core/init.php';

$user = new User();

if($_POST){

    $quiz_num= $_POST['quiz_id'];
    $quiz_answer = $_POST['answer'];

    for ($x = 0; $x <= 2; $x++) {
        $x;
        $q_id = $quiz_num[$x];
        $q_answer = $quiz_answer[$x];

        $mid = ($user->data()->memberID);
        $answer = filter_var($q_answer, FILTER_SANITIZE_STRING);
        $qid = filter_var($q_id, FILTER_SANITIZE_STRING);

        $sql = "INSERT INTO securityquestionanswer (SecQueID,memberID,answer)VALUES ('$qid','$mid','$answer')";
        $sql1 = "UPDATE clubmember SET securityquestions='1' WHERE memberID = '$mid'   ";

        if ($con->query($sql) === TRUE) {
            if($con->query($sql1) === TRUE){

            }else{
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
    $con->close();
}
?>

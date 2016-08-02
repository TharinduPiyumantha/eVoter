<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 01/08/2016
 * Time: 22:43
 */

require_once 'dbConfig.php';

if($_POST){

    $quiz_num= $_POST['quiz_id'];
    $quiz_answer = $_POST['answer'];

for ($x = 0; $x <= 2; $x++) {
    $x;
    $q_id = $quiz_num[$x];
    $q_answer = $quiz_answer[$x];

    $mid = "39";
    $answer = filter_var($q_answer, FILTER_SANITIZE_STRING);
    $qid = filter_var($q_id, FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO securityquestionanswer (SecQueID,memberID,answer)VALUES ('$qid','$mid','$answer')";

    if ($con->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}
    $con->close();
}
?>

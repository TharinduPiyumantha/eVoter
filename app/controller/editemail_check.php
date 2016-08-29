<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 08/08/2016
 * Time: 20:50
 */

require_once '../model/dbConfig.php';
require_once '../core/init.php';


/*$requestedEmail  = $_POST['email'];
$sql1 = "select email from clubmember WHERE email='$requestedEmail'";
$result1 = mysqli_query($con, $sql1);
$count1 = mysqli_num_rows($result1);

if ($count1>0) {
    /*$sql2 = "select memberID from clubmember WHERE email='$requestedEmail'";
    $result2 = mysqli_query($con, $sql2);
    while ($array = mysqli_fetch_row($result2)) {
        echo $array[0];
        if ($mid == $array[0]) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
    echo 'false';
} else {
    echo 'true';
}*/


require_once '../model/dbConfig.php';
$mid = $_POST['mid'];
$requestedEmail  = $_POST['email'];
$sql1 = "select * from clubmember WHERE email='$requestedEmail'";
$result1 = mysqli_query($con, $sql1);
$memID = $result1[0];
$count1 = mysqli_num_rows($result1);

if ($count1>0) {
    if($memID == $mid){
        echo 'true';
    }else {
        echo 'false';
    }
} else {
    echo 'true';
}
<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 08/08/2016
 * Time: 20:56
 */

require_once '../model/dbConfig.php';

$mid = $_POST['mid'];
$requestedUsername  = $_POST['username'];
$sql = "select * from clubmember WHERE username='$requestedUsername'";
$result = mysqli_query($con, $sql);
$memID = $result[0];
$count1 = mysqli_num_rows($result);

if ($count1>0) {
    if($memID == $mid){
        echo 'true';
    }else{
        echo 'false';
    }
} else {
    echo 'true';
}

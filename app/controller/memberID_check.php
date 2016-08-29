<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 11:42
 */

require_once '../model/dbConfig.php';

$requestedmid  = $_POST['mid'];
$sql1 = "select memberID from clubmember WHERE memberID='$requestedmid'";
$result1 = mysqli_query($con, $sql1);
$count1 = mysqli_num_rows($result1);

if ($count1>0) {
    echo 'false';
} else {
    echo 'true';
}

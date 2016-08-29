<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 11:37
 */

require_once '../model/dbConfig.php';

$requestedNIC  = $_POST['nic'];
$sql1 = "select NIC from clubmember WHERE NIC='$requestedNIC'";
$result1 = mysqli_query($con, $sql1);
$count1 = mysqli_num_rows($result1);

if ($count1>0) {
    echo 'false';
} else {
    echo 'true';
}
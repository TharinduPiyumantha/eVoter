<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 11:26
 */

require_once '../model/dbConfig.php';

$requestedEmail  = $_POST['email'];
$sql1 = "select email from clubmember WHERE email='$requestedEmail'";
$result1 = mysqli_query($con, $sql1);
$count1 = mysqli_num_rows($result1);

if ($count1>0) {
    echo 'false';
} else {
    echo 'true';
}

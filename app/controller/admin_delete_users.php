<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 21/08/2016
 * Time: 00:30
 */

require_once '../model/dbConfig.php';

$user_nic = $_GET['value'];
$sql = "UPDATE clubmember SET status='deleted-user' WHERE memberID = '$user_nic'";
$result = mysqli_query($con, $sql);

if ($con->query($sql) === TRUE) {

} else {
    echo 'Error: ' . $sql . '<br>' . $con->error;
     }

$con->close();
header("location: ../view/memberManage.php");
?>
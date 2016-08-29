<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 00:15
 */
require_once '../model/dbConfig.php';
require_once("../model/sms.php");
require_once("../model/email.php");
require_once '../core/init.php';

$user_mid = $_GET['value'];

    $sql = "DELETE FROM clubmember WHERE memberID= '$user_mid'";

    if ($con->query($sql) === TRUE) {

    } else {
        echo 'Error: ' . $sql . '<br>' . $con->error;
    }
$con->close();
header("location: ../view/userRequests.php");
?>

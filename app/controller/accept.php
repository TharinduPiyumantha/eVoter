<?php

/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/06/2016
 * Time: 12:55
 */

require_once '../model/dbConfig.php';
$user_nic = $_GET['value'];


    $sql = "UPDATE clubmember SET status='registered' WHERE NIC = '$user_nic'";

    if ($con->query($sql) === TRUE) {
        echo 'New record update successfully';
    } else {
        echo 'Error: ' . $sql . '<br>' . $con->error;
    }

    $con->close();
header("location: ../view/userRequests.php");
?>

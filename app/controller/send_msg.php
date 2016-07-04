<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 04/07/2016
 * Time: 00:39
 */

require_once '../core/init.php';
require_once '../model/dbConfig.php';
$user_nic = '916191197v';

$send_to_user = $_POST['to_user'];
$send_details = "SELECT * FROM clubmember WHERE name = '$send_to_user'";
$emp_name = mysqli_query($con, $send_details);
$array = mysqli_fetch_row($emp_name);
$to_user = $array[2];
$from_user = $user_nic;
$message1 = $_POST['msg'];
$date=date("Y-m-d");
$time=date("H:m:s");

$sql_for_send = "INSERT INTO messages(msg_time,msg_date,to_user, from_user, read_status, inbox_delete, outbox_delete, msg) VALUES ('$time','$date','$to_user','$from_user','0','0','0','$message1')";

if ($con->query($sql_for_send) === TRUE) {
    header('location:../view/msg_inbox.php');
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();


?>

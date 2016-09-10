<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 21:32
 */
require_once '../core/init.php';
require_once '../model/dbConfig.php';

$val = $_POST['check_list'];
$user_mid = $_GET['value'];
$user = new User();
$currentAdmin = $user->data()->memberID;
echo $currentAdmin;

for ($x = 0; $x <= 2; $x++) {
    $x;
    $memberID = $val[$x];
    echo $memberID;

    $sql = "UPDATE clubmember SET user_group='2'  WHERE memberID = '$user_mid'";
    $sql1 = "UPDATE clubmember SET user_group='1' WHERE memberID = '$currentAdmin'";
  /*  $result = mysqli_query($con, $sql);*/

    if ($con->query($sql1) === TRUE) {
        if ($con->query($sql) === TRUE) {
            /*if($user->hasPermission('administrator')){
                header('Location: ../view/home.php');
            }else{
                header('Location: ../view/memberHome.php');
            }*/
        }
    } else {
        echo 'Error: ' . $sql . '<br>' . $con->error;
    }

}

$sql = "UPDATE clubmember SET user_group='2' WHERE nic = '$memberID'";
$sql1 = "UPDATE clubmember SET user_group='1' WHERE memberID = '$currentAdmin'";
if ($con->query($sql1) === TRUE) {
    if ($con->query($sql) === TRUE) {
        /*if($user->hasPermission('administrator')){
            header('Location: ../view/home.php');
        }else{
            header('Location: ../view/memberHome.php');
        }*/
    }
} else {
    echo 'Error: ' . $sql . '<br>' . $con->error;
}


$con->close();
header("location: ../../index.php");
?>
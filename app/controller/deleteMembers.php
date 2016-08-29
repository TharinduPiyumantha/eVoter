<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 19:43
 */

require_once '../model/dbConfig.php';

$val = $_POST['check_list'];
     for ($x = 0; $x <= 2; $x++) {
        $x;
        $memberID = $val[$x];

        $sql = "UPDATE clubmember SET status='deleted-user' WHERE memberID = '$memberID'";
        $result = mysqli_query($con, $sql);

         if ($con->query($sql) === TRUE) {

         } else {
             echo 'Error: ' . $sql . '<br>' . $con->error;
         }
     }

$con->close();
header("location: ../view/memberManage.php");
?>
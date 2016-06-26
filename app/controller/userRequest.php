<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 16/06/2016
 * Time: 11:11
 */

require_once '../model/dbConfig.php';

$sql="SELECT * FROM clubmember where status = 'not-registered'";
$result = mysqli_query($con,$sql);
$new_requests = mysqli_num_rows($result);

?>
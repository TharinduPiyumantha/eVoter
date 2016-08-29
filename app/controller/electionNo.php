<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 16:03
 */

require_once '../model/dbConfig.php';

/*$currentDate = date("Y-m-d");
$sql = "SELECT MIN(date) FROM election WHERE date < '$currentDate'";
$result = mysqli_query($con,$sql);
$no_of_elections = mysqli_num_rows($result);
echo $no_of_elections*/

$currentDate = date("Y-m-d");
$sql = "SELECT MIN(date) FROM election WHERE date < '$currentDate'";
$result = mysqli_query($con,$sql);
$no_of_elections = mysqli_num_rows($result);
echo $no_of_elections;
?>
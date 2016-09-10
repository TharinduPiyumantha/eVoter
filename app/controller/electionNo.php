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
$sql = "SELECT MIN(date) FROM election WHERE date > '$currentDate'";
$result = mysqli_query($con,$sql);
/*$data =  mysqli_fetch_row($result);*/
$no_of_elections = mysqli_num_rows($result);

while ($data =  mysqli_fetch_row($result)){
    $election_date = $data[0];
    $sql2 = "SELECT * FROM election WHERE date = '$election_date'";
    $result2 = mysqli_query($con,$sql2);
    while ($array =  mysqli_fetch_row($result2)){
        $election_name = $array[1];
        $election_dates = $array[2];
        $election_start = $array[3];
        $election_ends = $array[4];

}}
?>
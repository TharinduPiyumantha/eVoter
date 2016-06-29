<?php
/**
 * Created by PhpStorm.
 * User: ShalikaFernando
 * Date: 6/25/2016
 * Time: 5:51 PM
 */


require_once ("../model/DB_1.php");

$db = new DB_1();
$connection = $db->connectToDatabase();
$key=$_GET['key'];
$array = array();

$query=mysqli_query($connection, "select name from clubmember where <coloumn_name> LIKE '%{$key}%'");
while($row=mysqli_fetch_assoc($query))
{
    $array[] = $row['title'];
}
echo json_encode($array);

?>
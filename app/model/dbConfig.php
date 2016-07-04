<?php

/*session_start();*/

$db_host="localhost";
$db_user = "root";
$db_pass = "";
$db_name="evoter";

/*
try {
    $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
    $db_con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}

$user = new USER($db_con);*/

$con = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
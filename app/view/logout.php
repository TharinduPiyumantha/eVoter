<?php
require_once "../core/init.php";

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$user = new User();
$user->logout();

header('Location:../../index.php');
?>
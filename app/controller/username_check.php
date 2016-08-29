<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 06/08/2016
 * Time: 20:36
 */

require_once '../model/dbConfig.php';

/*if($_POST){
    $check_username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);

    $sql = "SELECT username FROM clubmember WHERE username = '$check_username' ";
    $result = mysqli_query($con, $sql);

    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "wrongggggggggggggggggggg";
    }

    $con->close();
}
*/


/*$registeredEmail = array('werrt', 'thush', 'thush2');

$requestedEmail  = $_REQUEST['username'];

if( in_array($requestedEmail, $registeredEmail) ){
    echo 'false';
}
else{
    echo 'true';
}*/

$requestedUsername  = $_POST['username'];
$sql = "select username from clubmember WHERE username='$requestedUsername'";
$result = mysqli_query($con, $sql);
$count = mysqli_num_rows($result);

if ($count>0) {
    echo 'false';
} else {
    echo 'true';
}


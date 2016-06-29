<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 6/11/2016
 * Time: 12:09 PM
 */
class DB_1{

    public static function connectToDatabase()
    {
        $user = 'root';
        $pass = '';
        $database = 'evoter';
        $connect = mysqli_connect('localhost', $user, $pass) or die("Unable to connect");
        $select_db = mysqli_select_db($connect, $database) or die("Unable to connect to database");
        return $connect;
    }
}
?>
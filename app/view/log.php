<?php
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

if(Session::exists('success')){
    echo Session::flash('success');
}

$user = new User();
if($user->isLoggedIn()) {
    ?>
    <p>Hello <a href="#"><?php echo ($user->data()->username); ?></a></p>
    <ul>
        <li><a href="../view/logout.php">Logout</a></li>
    </ul>
    <?php
    if($user->hasPermission('administrator')){
        echo 'You are an admin';
    }
}else
{
    echo '<p>You need to <a href="app/view/login.php">Log in</a>';
}

?>
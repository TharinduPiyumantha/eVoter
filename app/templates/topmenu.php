<?php
require_once '../core/init.php';
?>
<!-- Navigation -->
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <?php
    $user = new User();
    if($user->hasPermission('administrator')){?>
        <a class="navbar-brand" href="../view/home.php" >eVoter</a>
    <?php }else{ ?>
        <a class="navbar-brand" href="../view/memberHome.php" >eVoter</a>
    <?php } ?>

</div>

<!-- Top Menu Items -->
<ul class="nav navbar-right top-nav">

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
        <ul class="dropdown-menu alert-dropdown">
            <li>
                <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
            </li>
            <li>
                <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
            </li>
            <li>
                <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
            </li>
            <li>
                <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
            </li>
            <li>
                <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
            </li>
            <li>
                <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">View All</a>
            </li>
        </ul>
    </li>

    <li class="dropdown">

        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
            <?php
            $user = new User();
            echo ($user->data()->name);
            ?>
            <b class="caret"></b></a>
        <ul class="dropdown-menu">

            <li>
                <a href="../view/editMyProfileInterface.php"><i class="fa fa-fw fa-user"></i> My Profile</a>
            </li>
            <li>
                <a href="../view/memberview.php"><i class="fa fa-fw fa-users"></i> Members </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="../view/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>
</ul>

<script>
    $('#toggleside').click(function() {
        $('#sidemenu').animate({width:'toggle'},350);
        $('.left-side').toggleClass("collapse-left");
        $(".right-side").toggleClass("strech");
    });
</script>

<!--End toggle side menu-->
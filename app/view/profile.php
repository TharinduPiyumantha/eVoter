<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 16/06/2016
 * Time: 11:52
 */
include "../templates/header.php";
require_once '../model/dbConfig.php';
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$user_nic = $_GET['value'];

$sql = "SELECT * FROM clubmember WHERE memberID = '$user_nic' ";
$result = mysqli_query($con, $sql);
?>
<!--<script src="../../public/js/userRequest.js"></script>-->

<body>

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <?php

            while ($array = mysqli_fetch_row($result)) {
            $memberid = $array[0];
            $name = $array[1];
            $nic = $array[2];
            $email = $array[3];
            $mobile=$array[4];
            $clubpost=$array[5];
            $profile_image="";
            $date_of_join=$array[9];
            ?>

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">  Profile : <?php echo $name?></h1>
                </div>
            </div>
<br>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="col-md-10 col-lg-offset-1" style="background-color: #004580;border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; border-top-left-radius: 20px;border-top-right-radius: 20px;">

                        <div class="col-md-2" style="margin-top: 30px;">
                            <div style="height: 200px;width: 200px;margin-left: 30px;"><img class="candidate" src="<?php echo SCRIPT_ROOT?>/public/images/user-images/user1.jpg" alt="" style="margin-top: 0px;">
                            </div>
                        </div>

                        <div class="col-md-8 col-md-offset-2" style="margin-top: 15px; margin-bottom: 20px;" >
                            <form class="form-horizontal" id="myprofile" name="myprofile" action="" role="form" method="post" style="margin-top: 30px;margin-right: 40px;color: #ffffff;">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="color: #ffffff;">Member Id : </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="mid" class="form-control" id="mid" value="<?php echo $memberid ?>" readonly >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="color: #ffffff;">Name :  </label>
                                    <div class="col-sm-8">
                                        <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $name ?>" readonly >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="color: #ffffff;">National Card Id :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="nic" class="form-control" id="nic" value="<?php echo $nic ?>" readonly >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="color: #ffffff;">Email Address :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="email" class="form-control" id="email" value="<?php echo $email ?>" readonly >
                                        <!--<label style="color: #004580;text-align: center;"><?php /*echo $email */?></label></label>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="color: #ffffff;">Contact Number :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="mob" class="form-control" id="mob" value="<?php echo $mobile ?>" readonly >
                                        <!--<label style="color: #004580;text-align: center;"><?php /*/*echo $mobile*/?></label>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="color: #ffffff;">Club Post :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="post" class="form-control" id="post" value="<?php echo $clubpost ?>" readonly >
                                        <!--<label style="color: #004580;text-align: center;"><?php /*/*echo $clubpost */?></label>-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" style="color: #ffffff;">Date of Join :</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="doj" class="form-control" id="doj" value="<?php echo $date_of_join ?>" readonly >
                                       <!-- <label style="color: #004580;text-align: center;"><?php /*/*echo $date_of_join */?></label>-->
                                    </div>
                                </div>
                                <div class="col-sm-8 col-sm-offset-7 controls">
                                    <a href="memberview.php">
                                        <button type="button" name="btn-cancel" class="btn btn-default btn-primary">
                                            <i class="fa fa-hand-o-left"></i>&nbsp;Back
                                        </button></a>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php
            }
            ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>

    </div>

</div>
</body>
</html>

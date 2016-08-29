<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 07/08/2016
 * Time: 23:12
 */

include "../templates/header.php";
require_once '../model/dbConfig.php';
require_once '../core/init.php';

$user = new User();
$memberID = $user->data()->memberID;
?>
<script src="../../public/js/myProfile.js"></script>
<body>

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php
        include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> My Profile </h1>
                </div>
            </div>

            <div>

                <?php
                $sql = "SELECT * FROM clubmember WHERE memberID = '$memberID' ";
                $result = mysqli_query($con, $sql);
                ?>

                <div id="my_profile" class="fill-height">
                    <form class="form-horizontal" id="myprofile" name="myprofile" action="" role="form" method="post" style="margin-top: 30px;margin-right: 40px;">

                        <?php

                        while ($array = mysqli_fetch_row($result))
                        {
                            $memberNo=$array[0];
                            $name=$array[1];
                            $nic = $array[2];
                            $email = $array[3];
                            $mob=$array[4];
                            $clubpost=$array[5];
                            $doj = $array[9];
                            $oldusername=$array[10];
                            $oldpwd=$array[11];
                            ?>

                            <div class="form-group" >
                                <label class="col-sm-4 control-label" style="color: #004580;">Full Name :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="fname" class="form-control" id="fname" style="display: none;" value="<?php echo $name ?>">

                                    <a href="" onclick="disp_qa()">Edit</a><br/><br />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Member ID :</label>
                                <div class="col-sm-8">
                                    <!--<label class="col-sm-4 control-label" name="mid" id="mid"  style="color: #004580;"><?php /*echo $memberNo */?></label>-->
                                    <input type="text" name="mid" class="form-control" id="mid" value="<?php echo $memberNo ?>" readonly >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">NIC :</label>
                                <div class="col-sm-8">
                                    <!--<label class="col-sm-4 control-label" name="nic" id="nic"  style="color: #004580;"><?php /*echo $nic*/?></label>-->
                                    <input type="text" name="nic" class="form-control" id="nic" value="<?php echo $nic?>" readonly >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" id="email" value="<?php echo $email ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Mobile Number :</label>
                                <div class="col-sm-8">
                                    <input type="tel" name="mobile" class="form-control" id="mobile" style="display: none;" value="<?php echo $mob ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color:#004580;">Club Post :</label>
                                <div class="col-sm-8">
                                    <!--<label class="col-sm-4 control-label" name="clubpost" id="clubpost"  style="color: #004580;"><?php /*echo $clubpost */?></label>-->
                                    <input type="text" name="clubpost" id="clubpost" class="form-control"  value="<?php echo $clubpost ?>" readonly >
                                    <div name="date_error" style="color: #004580; display: none">Error</div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Date of Join :</label>
                                <div class="col-sm-8">
                                    <!-- <label class="col-sm-4 control-label"name="doj"  id="doj"  style="color: #004580;"><?php /*echo $doj */?></label>-->
                                    <input type="text" name="doj" class="form-control" id="doj" value="<?php echo $doj ?>" readonly >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Username :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" class="form-control" id="username" value="<?php echo $oldusername ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Password :</label>
                                <div class="col-sm-8">
                                    <input type="password" name="pwd" class="form-control" id="pwd" value="<?php echo $oldpwd ?>">
                                </div>
                            </div>

                        <?php
                        }
                        ?>

                        <div class="col-sm-6 col-sm-offset-7 controls">
                            <button type="submit" id="btn-signup" name="btn-signup" class="btn btn-default btn-primary">
                                <i class="fa fa-hand-o-right"></i>&nbsp;UPDATE
                            </button>

                            <a href="home.php"><button type="button" name="btn-cancel" class="btn btn-default btn-primary">
                                    <i class="fa fa-ban"></i>&nbsp;CANCEL
                                </button></a>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

</body>

<script>
    function disp_qa()
    {
        event.preventDefault();
        document.getElementById("fname").style.display="block";
        /*document.getElementById("fname").style.display = "block";*/
    }

</script>

</HTML>

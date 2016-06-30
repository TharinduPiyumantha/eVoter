<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 16/06/2016
 * Time: 11:52
 */
include "../templates/header.php";
include "../controller/userRequest.php";
require_once '../model/dbConfig.php';
$user_nic = $_GET['value'];

$sql = "SELECT * FROM clubmember WHERE NIC = '$user_nic' ";
$result = mysqli_query($con, $sql);
?>
<script src="../../public/js/userRequest.js"></script>

<body>

<div id="wrapper">

    <nav class="navbar navbar-inverse navbar-fixed-top color-change" role="navigation" >
        <?php include "../templates/topmenu.php";
        include "../templates/sidemenu.php";
        ?>
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> User Profile </h1>
                </div>
            </div>
            <br>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="col-lg-4">
                        <div style="height: 200px;width: 200px;margin-left: 30px;"><img class="candidate" src="<?php echo SCRIPT_ROOT ?>/public/images/user-images/user1.jpg" alt="" style="margin-top: 0px;"></div>
                    </div>

                    <div class="col-lg-8">
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

                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Member Id : </label>
                                <div class="col-sm-8">
                                    <label style="color: #004580;text-align: center;"><?php echo $memberid ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Name :  </label>
                                <div class="col-sm-8">
                                    <label style="color: #004580;text-align: center;"><?php echo $name ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">National Card Id :</label>
                                <div class="col-sm-8">
                                    <label style="color: #004580;text-align: center;"><?php echo $nic ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Email Address :</label>
                                <div class="col-sm-8">
                                    <label style="color: #004580;text-align: center;"><?php echo $email ?></label></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Contact Number :</label>
                                <div class="col-sm-8">
                                    <label style="color: #004580;text-align: center;"><?php echo $mobile?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Club Post :</label>
                                <div class="col-sm-8">
                                    <label style="color: #004580;text-align: center;"><?php echo $clubpost ?></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #004580;">Date of Join :</label>
                                <div class="col-sm-8">
                                    <label style="color: #004580;text-align: center;"><?php echo $date_of_join ?></label>
                                </div>
                            </div>

                            <div class="col-sm-6 col-sm-offset-7 controls">
                                <a href="../controller/accept.php?value=<?php echo $array[2]?>"><button type="submit" id="btn-signup" name="btn-signup" class="btn btn-default btn-primary">
                                    <i class="fa fa-hand-o-right"></i>&nbsp;Accept
                                </button>

                                <a href="#"><button type="button" name="btn-cancel" class="btn btn-default btn-primary">
                                        <i class="fa fa-ban"></i>&nbsp;Reject
                                    </button></a>
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

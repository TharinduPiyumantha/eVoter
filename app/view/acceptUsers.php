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
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

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

                    <div class="col-md-10 col-lg-offset-1" style= "background-color: #004580; height:480px; border-bottom-left-radius:20px; border-bottom-right-radius: 20px; border-top-left-radius: 20px;border-top-right-radius: 20px;">
                        <div class="col-md-2" style="margin-top: 30px;">
                            <div style="height: 200px;width: 200px;margin-left: 30px;"><img class="candidate" src="<?php echo SCRIPT_ROOT?>/public/images/user-images/user1.jpg" alt="" style="margin-top: 0px;">
                            </div>
                        </div>

                        <div class="col-md-8 col-md-offset-2" style="margin-top: 15px; margin-bottom: 20px;" >
                        <?php
                        while ($array = mysqli_fetch_row($result)) {
                            $memberid = $array[0];
                            $name = $array[1];
                            $nic = $array[2];
                            $email = $array[3];
                            $mobile=$array[4];
                            $clubpost=$array[5];
                            $date_of_join=$array[9];
                            ?>

                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #ffffff;margin-top: 20px;">Member Id : </label>
                                <div class="col-sm-8">
                                    <input type="text" name="mid" class="form-control" id="mid" style="margin-top: 20px;" value="<?php echo $memberid ?>">
                                 </div>
                            </div>
                            <div class="form-group" >
                                <label class="col-sm-4 control-label" style="color: #ffffff;margin-top: 10px;">Name :  </label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" id="name"  style="margin-top: 10px;" value="<?php echo $name ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #ffffff;margin-top: 10px;">National Card Id :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nic" class="form-control" id="nic" style="margin-top: 10px;" value="<?php echo $nic ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #ffffff;margin-top: 10px;">Email Address :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" class="form-control" id="email" style="margin-top: 10px;" value="<?php echo $email ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #ffffff;margin-top: 10px;">Contact Number :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="mobile" class="form-control" id="mobile" style="margin-top: 10px;" value="<?php echo $mobile?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #ffffff;margin-top: 10px;">Club Post :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="clubpost" class="form-control" id="clubpost" style="margin-top: 10px;" value="<?php echo $clubpost ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" style="color: #ffffff;margin-top: 10px;">Date of Join :</label>
                                <div class="col-sm-8">
                                    <input type="text" name="clubpost" class="form-control" id="clubpost" style="margin-top: 10px;" value="<?php echo $date_of_join ?>">
                                </div>
                            </div>

                            <div class="col-sm-6 col-sm-offset-7 controls" style="margin-top: 20px;">
                                <a href="../controller/accept.php?value=<?php echo $array[0]?>"><button type="submit" id="btn-signup" name="btn-signup" class="btn btn-default btn-primary">
                                    <i class="fa fa-hand-o-right"></i>&nbsp;Accept
                                </button>

                                <a href="../controller/reject.php?value=<?php echo $array[0]?>" onclick="return confirm('Are you sure?')" ><button type="button" name="btn-cancel" class="btn btn-default btn-primary" >
                                        <i class="fa fa-ban"></i>&nbsp;Reject
                                    </button></a>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                        </div>
                </div>
            </div>
            <!-- /.row -->

        </div>

    </div>

</div>
</body>
</html>

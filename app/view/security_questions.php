<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 01/08/2016
 * Time: 14:19
 */

include "../templates/header.php";
require_once '../model/dbConfig.php';
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

if($_POST) {
    $quiz_num= $_POST['check_list'];
    header("location:security_answers.php?card=".$quiz_num);
}
?>
<script src="../../public/js/validate_checkbox.js"></script>
</head>

<body style="background-color:#ffffff;margin-top: -0px;">
<div class="col-lg-12"">
<div class="col-lg-6 " style="border-color: #f6d224;height:100%;">
    <img src="../../public/images/e-voter logo 1.png" style="margin-top: 115px;margin-left: 30px;">
</div>

<div class="col-lg-6 fill-height" style="background-color:#004580;border-color: #f6d224;height:100%;">

    <div class="head-text"><h4 style="color:#f6d224;font-size: 30px;margin-top: 30px;"><strong>Security Questions</strong></h4>
        <span><p style="color:#f6d224;margin-top: 20px;">The security questions and answers provide here is for  further authenticate your identity when you sign on to voting process in eVoter system.This will minimize the risk of potential unauthorized access to your information about voting. </p></span>
        <span><p style="color:#f6d224;">Please select 03 questions which you can remember and press NEXT Button</p></span>
        <hr>
        <div id="contact_results"></div>
    </div>

    <div id="quiz-form" >
        <form class="form-horizontal" id="quizform" name="quizform" action="security_answers.php" role="form" method="post" style="margin-top: 30px;margin-right: 40px;">

            <div id="errors" style="color:#ff0000;border-color:#ff0000;margin-left: 210px;">
            </div>

            <div style="color: #ffffff;float: center;margin-left: 80px;margin-top: 20px;">
                <?php
                $sql = "SELECT * FROM securityquestions";
                $result = mysqli_query($con, $sql);


                while ($array = mysqli_fetch_row($result))
                {?>


                    <input name="check_list[]" id="<?php echo $array[0] ?>" class="CheckBoxSchedule" type="checkbox" value="<?php echo $array[0] ?>">
                    <?php echo $array[1] ; ?> <br>

                <?php
                }
                ?>

            </div>

            <div class="col-sm-6 col-sm-offset-7 controls" style="margin-top: 40px;">

                <button type="submit" id="btn-submit" name="btn-submit" class="btn btn-default btn-primary">
                    <i class="fa fa-hand-o-right"></i>&nbsp;NEXT
                </button>

                <a href="../../index.php"><button type="button" name="btn-cancel" class="btn btn-default btn-primary">
                        <i class="fa fa-ban"></i>&nbsp;NOT NOW
                    </button></a>
            </div>

        </form>
    </div>
</div>
</div>
</body>
</html>
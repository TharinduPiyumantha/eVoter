<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 01/08/2016
 * Time: 14:50
 */

include "../templates/header.php";
require_once '../model/dbConfig.php';
require_once '../core/init.php';

$user = new User();
if (!$user->isLoggedIn()){
    header('Location: ../../index.php');
}

$val = $_POST['check_list'];
?>
<script src="../../public/js/answer.js"></script>

</head>

<body style="background-color:#ffffff;margin-top: -0px;">
<div class="col-lg-12"
">
<div class="col-lg-6 " style="border-color: #f6d224;height:100%;">
    <img src="../../public/images/e-voter logo 1.png" style="margin-top: 115px;margin-left: 30px;">
</div>

<div class="col-lg-6 fill-height" style="background-color:#004580;border-color: #f6d224;height:100%;">

    <div class="head-text"><h4 style="color:#f6d224;font-size: 30px;margin-top: 30px;"><strong>Security
                Questions</strong></h4>
        <span><p style="color:#f6d224;margin-top: 20px;">The security questions and answers provide here is for further
                authenticate your identity when you sign on to voting process in eVoter system.This will minimize the
                risk of potential unauthorized access to your information about voting. </p></span>
        <span><p style="color:#f6d224;">Please answer 03 questions which you select, remember answers and press SUBMIT
                Button</p></span>
        <hr>

        <div id="contact_results"></div>
    </div>

    <div class="answer-success hidden col-lg-8 col-md-8 col-sm-8 col-lg-offset-2" id="answer-success"
         style="color:#000000;">
        <h3> Welcome....! </h3>
        <p style="color:#f6d224;">Your security Questions have saved successfully. WELCOME to eVoter !!!>
            <a href="../../index.php" style="color:#ffffff;">CLICK here</a> to log into the system. Thank You for your cooperation.</p>

    </div>

    <div id="answer-form">
        <form class="form-horizontal" id="answerform" name="answerform" action="" role="form" method="post"
              style="margin-top: 30px;margin-right: 40px;">

            <div style="color: #ffffff;float: center;margin-left: 80px;margin-top: 20px;">
                <?php
                for ($x = 0; $x <= 2; $x++) {
                    $x;
                    $q_id = $val[$x];

                    $sql = "SELECT * FROM securityquestions WHERE q_id = $q_id ";
                    $result = mysqli_query($con, $sql);

                    while ($array = mysqli_fetch_row($result)) {
                        echo $array[1]; ?> <br>
                        <input type="hidden" name="quiz_id[]" value="<?php echo $q_id?>">
                        <input type="text" name="answer[]" style="color: #000000;width: 300px;"><br><br>
                    <?php
                    }
                }
                ?>

            </div>

            <div class="col-sm-5 col-sm-offset-7 controls" style="margin-top: 40px;margin-left: 270px;width: 330px;padding-right: 15px;">

                <button type="submit" id="btn-submit" name="btn-submit" class="btn btn-default btn-primary">
                    <i class="fa fa-thumbs-o-up"></i>&nbsp;SUBMIT
                </button>

                <a href="security_questions.php"><button type="button" name="btn-cancel" class="btn btn-default btn-primary">
                        <i class="fa fa-hand-o-left"></i>&nbsp;BACK
                    </button></a>

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
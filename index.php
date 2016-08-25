<?php
/**
 * Created by PhpStorm.
 * User: Dili
 * Date: 29/06/2016
 * Time: 08:35
 */

include 'app/templates/header.php';
require_once 'app/core/init.php';
require_once("app/model/ballotPaper.php");
require_once("app/model/DB_1.php");

$db = new DB_1();
$connection = $db->connectToDatabase();

if(Input::exists())
    if(Token::check(Input::get('token'))){
        $validate = new Validate();
        $validation = $validate->check($_POST,array(
            'username' => array('required' => true),
            'password' => array('required' => true)
        ));

        if($validation->passed()){
            $user = new User();
            $ballot = new BallotPaper();
            $login = $user->login(Input::get('username'), Input::get('password'));
            //echo ($user->data()->memberID);

            if($login){
                //$check = $ballot->checkanswer($connect,$user->data()->memberID);
                if (($user->data()->securityquestions)== '0'){
                    header('Location: app/view/security_questions.php');
                }
                else if($user->hasPermission('administrator')){
                    header('Location: app/view/home.php');
                }else{
                    header('Location: app/view/memberHome.php');
                }

            } else{
                $message = "Sorry!!!\\n Username or Password is incorrect.\\n Please Try again.";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }else{
            foreach($validation->errors() as $error){
                echo $error, '<br>';
            }
        }
    }
?>

<script src="../../public/js/signup.js"></script>

</head>

<body style="background-color:#ffffff;margin-top: -0px;">
<div class="col-lg-12"">
<div class="col-lg-6 " style="border-color: #f6d224;height:100%;">
    <img src="public/images/e-voter logo 1.png" style="margin-top: 115px;margin-left: 30px;">
</div>

<div class="col-lg-6 fill-height" style="background-color:#004580;border-color: #f6d224;height:100%;">

    <br><br>
    <div class="head-text"><h4 style="color:#f6d224;font-size: 30px;"><strong>WELCOME</strong></h4>
        <!--<span><p style="color:#f6d224;">All fields are required</p></span>-->
    </div>

    <div id="signup-form">
        <form class="form-horizontal" action="" method="post" style="margin-top: 30px;margin-right: 40px;">
            <div class="form-group" >
                <label for="username" class="col-sm-4 control-label" style="color: #ffffff;">Username :</label>
                <div class="col-sm-8">
                    <input type="text" name="username" id="username" autocomplete="off" class="form-control" placeholder="Username">
                </div>
            </div>
            <div class="form-group" >
                <label for="password" class="col-sm-4 control-label" style="color: #ffffff;">Password :</label>
                <div class="col-sm-8">
                    <input type="password" name="password" id="password" autocomplete="off" class="form-control" placeholder="Password">
                </div>
            </div>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">

            <br>

            <div class="col-sm-6 col-sm-offset-7 controls" style="margin-left: 350px;">
                <button type="submit" value="Log In" class="btn btn-default btn-primary">
                    <i class="fa fa-sign-in"></i>&nbsp;SIGN IN
                </button>

                <a href="app/view/signup.php"><button type="button" id="btn-signup" name="btn-signup" class="btn btn-default btn-primary">
                    <i class="fa fa-hand-o-right"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br><br>
            <a href="changepassword.php" style="color: #ffffff;margin-left: 450px;">Change password</a>

        </form>
    </div>

</div>

</div>

</body>

</html>
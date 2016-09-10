<?php include "../templates/header.php";
require_once '../core/init.php';
?>
<script src="../../public/js/signup.js"></script>

<script type="text/javascript">
    function checkform()
    {
        var dateString = document.signupform.doj.value;
        var myDate = new Date(dateString);
        var today = new Date();
        if (myDate>today)
        {
            //something else is wrong
            document.getElementById('date_error').style.display="";
            /*alert('You cannot enter a date in the future!');*/

            return false;
        }
        // if script gets this far through all of your fields
        // without problems, it's ok and you can submit the form
        return true;
    }
</script>

</head>

<body style="background-color:#ffffff;margin-top: -0px;">
<div class="col-lg-12"">
<div class="col-lg-6 " style="border-color: #f6d224;height:100%;">
    <img src="../../public/images/e-voter logo 1.png" style="margin-top: 115px;margin-left: 30px;">
</div>

<div class="col-lg-6 fill-height" style="background-color:#004580;border-color: #f6d224;height:100%;">

    <div class="head-text"><h4 style="color:#f6d224;font-size: 30px;"><strong>WELCOME</strong></h4>
        <span><p style="color:#f6d224;">All fields are required</p></span>
        <div id="contact_results"></div>
    </div>

    <div class="signup-success hidden col-lg-8 col-md-8 col-sm-8 col-lg-offset-2" id="signup-success"
         style="color:#000000;">
        <h3>Thank You....!</h3>
        <p style="color:#f6d224;">You have registered successfully. Please wait for the administration confirmation. You will get a mail with login details.
            <a href="../../index.php" style="color:#ffffff;">CLICK here</a> to log</p>
    </div>

    <div id="signup-form" class="fill-height">
        <form class="form-horizontal" id="signupform" name="signupform" action="" role="form" method="post" style="margin-top: 30px;margin-right: 40px;" onsubmit="return checkform()">
            <div class="form-group" >
                <label class="col-sm-4 control-label" style="color: #ffffff;">Full Name :</label>
                <div class="col-sm-8">
                    <input type="text" name="fname" class="form-control" id="fname" placeholder="Name">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Member ID :</label>
                <div class="col-sm-8">
                    <input type="text" name="mid" class="form-control" id="mid" placeholder="Member ID">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">NIC :</label>
                <div class="col-sm-8">
                    <input type="text" name="nic" class="form-control" id="nic" placeholder="National Identity Number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Email :</label>
                <div class="col-sm-8">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Mobile Number :</label>
                <div class="col-sm-8">
                    <input type="tel" name="mobile" class="form-control" id="mobile" placeholder="Mobile Number">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Date of Join :</label>
                <div class="col-sm-8">
                    <input type="date" name="doj" class="form-control" id="doj" placeholder="dd/mm/yyyy">
                    <div name="date_error" style="color: #ffffff; display: none">Error</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Club Post :</label>
                <div class="col-sm-8">
                    <select class="form-control" name="clubpost">
                        <option disabled selected value>-- Select Club Post --</option>
                        <option name="clubpost" id="clubpost" value="President">President</option>
                        <option name="clubpost" id="clubpost" value="Vice President">Vice President</option>
                        <option name="clubpost" id="clubpost" value="Secretary">Secretary</option>
                        <option name="clubpost" id="clubpost" value="Vice Secretary">Vice Secretary</option>
                        <option name="clubpost" id="clubpost" value="Treasurer">Treasurer</option>
                        <option name="clubpost" id="clubpost" value="Assistant Treasurer">Assistant Treasurer </option>
                        <option name="clubpost" id="clubpost" value="Editor">Editor</option>
                        <option name="clubpost" id="clubpost" value="Coordinator">Coodinaator</option>
                        <option name="clubpost" id="clubpost" value="Member">Member</option>
                    </select>
                    <!--<input type="text" name="clubpost" class="form-control" id="clubpost" placeholder="Club Post">-->
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Username :</label>
                <div class="col-sm-8">
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Password :</label>
                <div class="col-sm-8">
                    <input type="password" name="pwd" class="form-control" id="pwd" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" style="color: #ffffff;">Confirm Password :</label>
                <div class="col-sm-8">
                    <input type="password" name="confirmpwd" class="form-control" id="confirmpwd" placeholder="Confirm Password">
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-7 controls">
                <button type="submit" id="btn-signup" name="btn-signup" class="btn btn-default btn-primary">
                    <i class="fa fa-hand-o-right"></i>&nbsp;SIGN UP
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
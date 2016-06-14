<?php include "../templates/header.php";?>
<!--<script src="../../public/js/signup.js"></script>-->

</head>

<body style="background-color:#ffffff;margin-top: -0px;">
<div class="col-lg-12"">
        <div class="col-lg-6" style="border-color: #f6d224;height:100%;">
        </div>
<div class="signup-success hidden col-lg-8 col-md-8 col-sm-8 col-lg-offset-2" id="signup-success">
    <h3>Thank You....!</h3>
    <p>You have registered successfully. Please wait for the administration confirmation. You will get a mail with login details.
        <a href="../../index.php">CLICK here</a> to log</p>

</div>

        <div class="col-lg-6" id="signup-form" style="background-color:#004580;border-color: #f6d224;height:100%;">
            <h2 style="color: #ffffff;text-align: center;">Registration Form</h2>
            <form class="form-horizontal" id="signupform" name="signupform" action="" role="form" method="post" style="margin-top: 30px;margin-right: 40px;">
                <div class="form-group" >
                    <label class="col-sm-4 control-label" style="color: #ffffff;">Full Name :</label>
                    <div class="col-sm-8">
                        <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name">
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
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" style="color: #ffffff;">Club Post :</label>
                    <div class="col-sm-8">
                        <input type="text" name="clubpost" class="form-control" id="clubpost" placeholder="Club Post">
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

                    <a href="#"><button type="button" name="btn-cancel" class="btn btn-default btn-primary">
                            <i class="fa fa-ban"></i>&nbsp;NOT NOW
                        </button></a>
                </div>
            </form>
        </div>
    </div>
</body>


<script>
    $('#btn-signup').click(function(){
        //alert('ffff');
        test();
    });
    function test(){
        var t = 3;
        $.ajax({
            url: 't.php',
            data: t,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response) {
                var obj = jQuery.parseJSON(response);
                console.log(obj);
                //load json data from server and output message
                /*if (response.type == "text"){
                 //$("#signup-success-text").html(response.text);
                 $("#signup-form").slideUp("slow",function(){
                 $("#signup-success").removeClass("hidden",function(){
                 $("#signup-success").fadeIn(600);
                 });
                 });


                 }else{
                 $("#signup-success").html(response.text);
                 }*/

            }
        });
    }

</script>
</html>
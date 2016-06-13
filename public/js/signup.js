/**
 * Created by Dili on 12/06/2016.
 */

$().ready(function(){
    $('#btn-signup').click(function(){
    $("#signupform").validate({
        rules:{
            fname:{
                required: true,
            }
        },

        messages:{
            fname:{
                required: "Please enter your first name"
            }
        },

        submitHandler: function(form) {
            //get input field values data to be sent to server
            var m_data = new FormData();
            m_data.append( 'fname',  document.getElementById("fname").value);
            // Ajax post data to server
            $.ajax({
                url: '../../app/controller/member_signup.php',
                data: m_data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType:'json',
                success: function(response){
                    //load json data from server and output message
                    if (response.type == "text"){
                        //$("#signup-success-text").html(response.text);
                        $("#signup-form").slideUp("slow",function(){
                            $("#signup-success").removeClass("hidden",function(){
                                $("#signup-success").fadeIn(600);
                            });
                        });


                    }else{
                        $("#signup-success").html(response.text);
                    }


                }
            });


        }

    });
    });
});
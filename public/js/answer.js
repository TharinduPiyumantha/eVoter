/**
 * Created by Dili on 01/08/2016.
 */

$().ready(function(){
    $('#btn-submit').click(function(){
        $("#answerform").validate({
            rules:{
                "answer[]":{
                    required:true
                }

            },
            messages:{
            "answer[]":{
                required: "Please enter your answer"
            }
        },
            submitHandler: function(form) {
                $.ajax({
                    type: "POST",
                    url: '../../app/model/answer.php',
                    data: $("#answerform").serialize(), // serializes the form's elements.
                    success: function (data) {

                        $("#answerform").slideUp("slow", function () {
                            $("#answer-success").removeClass("hidden", function () {
                                $("#answer-success").fadeIn(600);
                            });
                        });

                    }

                });
            }
    });
        });
    });

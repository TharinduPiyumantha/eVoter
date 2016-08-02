

$().ready(function(){
    $('#btn-submit').click(function(){
        $("#quizform").validate({

            errorElement: "div",
            //place all errors in a <div id="errors"> element
            errorPlacement: function(error, element) {
                error.appendTo("div#errors");
            },

            rules: {
        'check_list[]': {
            required: true,
            maxlength: 3,
            minlength: 3
        }
    },
    messages: {
        'check_list[]': {
            required: "You must check 3 box",
            maxlength: "ATTENTION : Check only 3 questions",
            minlength: "ATTENTION : Check 3 questions"
        }
    }
        });
    });
});


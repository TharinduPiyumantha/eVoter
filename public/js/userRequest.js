/**
 * Created by Dili on 16/06/2016.
 */

$(document).ready(
    function() {
        setInterval(function() {
            $.ajax({
                url: '../../app/controller/userRequest.php' ,
                cache: false,

                success: function(data)
                {
                    $('#memberRequest').val(data);
                }
            });
        }, 1000);
    });
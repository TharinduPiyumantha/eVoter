

/*--------- Side Menu ---------*/

/*Window height*/
$(function(){
    $(window).load(function(){ // On load
        var winheight = $(window).height();
        var wfinal = winheight - 51;
        $('#sidemenu').css({'height':(wfinal)+'px'});
    });
    $(window).resize(function(){ // On resize
        var winheight = $(window).height();
        var wfinal = winheight - 51;
        $('#sidemenu').css({'height':(wfinal)+'px'});
        if($(window).width <=768){
            $(".right-side").toggleClass("strech");
        }
    });
});

/*End Window height*/

/*--------- End Side Menu ---------*/
/**
 * Created by Dili on 16/06/2016.
 */

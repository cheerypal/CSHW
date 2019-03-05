$(window).scroll(function(){
    let scroll = $(window).scrollTop();
    if(scroll > 0){
        $("#myNav").css(  'box-shadow', '0 0 50px rgba(0,0,0,0.4)');
    }else{
        $("#myNav").css('box-shadow', '0 0 0 rgba(0,0,0,0.4)');
    }
});
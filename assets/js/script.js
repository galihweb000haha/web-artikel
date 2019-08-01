$(document).ready(function() {
$(window).scroll(function(){
var wScroll =  $(this).scrollTop();
    $('.jumbotron img').css({
        'transform' : 'translate(0px,'+ wScroll/4 +'%)'
    });
    $('.jumbotron h1').css({
        'transform' : 'translate(0px,'+ wScroll/2 +'%)'
    });
    $('.jumbotron p').css({
        'transform' : 'translate(0px,'+ wScroll/1.5 +'%)'
    });
    
    

    if(wScroll > $('.row').offset().top - 500){
        $('article .col-md-6').each(function(i){
            setTimeout(function(){
                $('article .col-md-6').eq(i).addClass('muncul');
            }, 300 * (i+1));
        });
     


       
       $('aside').addClass('munculAside');
    }
});


    $('#keyword').on('keyup', function() {
        $('#container').load('../../admin/ajax/artikel.php?keyword=' + $('#keyword').val());
    });
});
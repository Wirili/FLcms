$(function(){
    $(".right").css('height',($(window).height()-70)+'px');
    leftmu();
})



function leftmu(){
    //$(selector).toggle(speed,callback);
    $(".left [class='sub-menu']").each(function(){
        $(this).prev().click(function(e) {
            var zicd=$(this).next(".sub-menu");
            //$(this).next(".sub-menu").toggle(500);
            $(".sub-menu").not(zicd).prev().each(function(){
                $(this).next(".sub-menu").hide(400);
                $(this).find(".llong1").removeClass("glyphicon-menu-down");
                $(this).find(".llong1").addClass("glyphicon-menu-left")	;
            })
            if($(zicd).is(":hidden")){
                $(this).find(".llong1").removeClass("glyphicon-menu-left");
                $(this).find(".llong1").addClass("glyphicon-menu-down");
                $(zicd).show(400);
            }else{
                $(zicd).hide(400);
                $(this).find(".llong1").removeClass("glyphicon-menu-down");
                $(this).find(".llong1").addClass("glyphicon-menu-left");
            }
        });
    });
}
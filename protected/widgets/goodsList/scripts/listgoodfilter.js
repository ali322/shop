$('.supplier_selector').mouseenter(function(){
    $(this).find('.text').css('border-bottom','1px solid #FFF').find('b').css('border-bottom','1px solid #CECBCE');
    $(this).find('.text').next().show();
}).mouseleave(function(){
        $(this).find('.text').css('border-bottom','1px solid #CECBCE').find('b').css('border-bottom','1px solid #FFF');
        $(this).find('.text').next().hide();
    });
$('.list_style_selector b').click(function(){
    $('.list_goods_wrap').find('.items').attr('class','items list_items');
    $(this).addClass('curr').parent().prev().find('b').removeClass('curr');
});
$('.detail_style_selector b').click(function(){
    $('.list_goods_wrap').find('.items').attr('class','items');
    $(this).addClass('curr').parent().next().find('b').removeClass('curr');
});
$('.list_goods_wrap .items li').mouseenter(function(){
    $(this).addClass('hover_item');
}).mouseleave(function(){
        $(this).removeClass('hover_item');
    });
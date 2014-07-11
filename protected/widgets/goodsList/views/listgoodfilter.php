<div class='list_goods_filter'>
    <dl>
        <dt>供应商:</dt>
        <dd class='supplier_selector'><div class='text'>请选择供应商<b></b></div><div class='content' style='display:none;'>
            <p><a href=''>测试供应商</a></p>
            <p><a href=''>测试供应商</a></p>
            <p><a href=''>测试供应商</a></p>
        </div></dd>
    </dl>
    <dl  class='type_selector_dl'>
        <dt>商品类型:</dt>
        <dd class='type_selector'><a href='a' class='selected'><b></b>全部</a></dd>
        <dd class='type_selector'><a href='a'><b></b>特价</a></dd>
        <dd class='type_selector'><a href='a'><b></b>限时促销</a></dd>
    </dl>
    <dl class='style_selector'>
        <dd class='detail_style_selector'><b class='curr'>大图</b></dd><dd class='list_style_selector'><b>列表</b></dd>
    </dl>
</div>
<?php Yii::app()->clientScript->registerScript('supplier_selector',"
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
",CClientScript::POS_END);?>
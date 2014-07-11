<div class='list_credits_filter list_goods_filter'>
    <dl class='credits_range'>
        <dt>分值范围:</dt>
        <dd><a href="javascript:void(0);">全部</a></dd>
        <dd><a href="javascript:void(0);">我能兑换的</a></dd>
        <dd class='curr'><a href="javascript:void(0);">0-300</a></dd>
        <dd><a href="javascript:void(0);">300-1000</a></dd>
        <dd><a href="javascript:void(0);">1000-2000</a></dd>
        <dd><a href="javascript:void(0);">2000-5000</a></dd>
        <dd><a href="javascript:void(0);">5000-10000</a></dd>
        <dd><a href="javascript:void(0);">10000以上</a></dd>
    </dl>
    <dl class='style_selector'>
        <dd class='detail_style_selector'><b class='curr'>大图</b></dd><dd class='list_style_selector'><b>列表</b></dd>
    </dl>
</div>
<?php Yii::app()->clientScript->registerScript('list_credits',"
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
<dl>
    <dt>供应商:</dt>
    <dd class='supplier_selector'><div class='text'>请选择供应商<b></b></div><div class='content' style='display:none;'>
        <p><a href=''>测试供应商</a></p>
        <p><a href=''>测试供应商</a></p>
        <p><a href=''>测试供应商</a></p>
    </div></dd>
</dl>
<?php Yii::app()->clientScript->registerScript('supplier_selector',"
    $('.supplier_selector').mouseenter(function(){
        $(this).find('.text').css('border-bottom','1px solid #FFF').find('b').css('border-bottom','1px solid #CECBCE');
        $(this).find('.text').next().show();
    }).mouseleave(function(){
        $(this).find('.text').css('border-bottom','1px solid #CECBCE').find('b').css('border-bottom','1px solid #FFF');
        $(this).find('.text').next().hide();
    });
",CClientScript::POS_END);?>
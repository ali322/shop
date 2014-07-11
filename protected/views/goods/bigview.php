<div class="bigview_wrap clear">
    <div class="bigview_lft">
        <h1><?php echo $good->good_name; ?><b>(商品编号:<?php echo $good->good_sn; ?>)</b><a href="<?php echo $this->createUrl('goods/view',array('id'=>$good->good_id));?>">返回商城</a></h1>
        <div class="bigview_pic" id='bigview_pic'>
            <?php foreach(explode(',',$good->goodDetail->good_gallery) as $row){ ?>
            <img src="<?php echo $good->goodDetail->getImageUrl().'/'.$row;?>" alt="">
            <?php } ?>
        </div>
        <div class="bigview_btn"><a href=""></a></div>
    </div>
    <div class="bigview_rgt">
        <div class="bigview_slider">
            <span class='bigview_slider_lft'><b class='noctrl'></b></span>
            <span class='bigview_slider_rgt'><b class=''></b></span>
            <div class="bigview_slider_list">
                <div class="bigview_slider_listbox">
                <ul class='curr'>
                    <?php foreach(explode(',',$good->goodDetail->good_gallery) as $i=>$row){?>
                    <?php if($i%6==0 && $i>0){?>
                    </ul><ul>
                    <?php }?>
                    <li><img src="<?php echo $good->goodDetail->getImageUrl().'/'.$row; ?>" alt=""></li>
                    <?php }?>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php Yii::app()->clientScript->registerScript('good_bigview',"
    $('.bigview_slider_lft').click(function(){
        var curUl=$('.bigview_slider_list ul.curr'),index=curUl.index();
        if(index > 0){
            curUl.removeClass('curr').prev('ul').addClass('curr');
            $('.bigview_slider_listbox').animate({'margin-top':'-'+695*--index+'px'},'slow');
            if(index==0){
                $('.bigview_slider_lft').children().addClass('noctrl');
            }
            if(index<$('.bigview_slider_list ul').length-1){
                $('.bigview_slider_rgt').children().removeClass('noctrl');
            }
        }else{
            return false;
        }
    });
    $('.bigview_slider_rgt').click(function(){
        var curUl=$('.bigview_slider_list ul.curr'),index=curUl.index();
        if(index < $('.bigview_slider_list ul').length-1){
            curUl.removeClass('curr').next('ul').addClass('curr');
            $('.bigview_slider_listbox').animate({'margin-top':'-'+695*++index+'px'},'slow');
            if(index == $('.bigview_slider_list ul').length-1){
                $('.bigview_slider_rgt').children().addClass('noctrl');
            }
            if(index>0){
                $('.bigview_slider_lft').children().removeClass('noctrl');
            }
        }else{
            return false;
        }
    });
",CClientScript::POS_END);?>
<?php $this->widget('ext.omui.OmuiSlider',array(
    'sliderId'=>'bigview_pic',
    'navId'=>'.bigview_slider_list ul',
    'options'=>array(
        'autoPlay'=>false,
        'directionNav'=>true,
        'interval'=>3000
    )
));?>
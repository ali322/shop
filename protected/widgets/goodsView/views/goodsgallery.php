<div class="product_pic" id='product_pic'>
    <a href="<?php echo $goodImagePath.'/'.$goodImage;?>" class='jqzoom' rel="gal1"  title="triumph">
        <img class='product_img' src="<?php echo $goodImagePath.'/'.$goodImage;?>" alt="">
    </a>
</div>
<div class="product_gallery_slider">
    <span class='p_g_slider_lft'><b class='noctrl'></b></span>
    <span class='p_g_slider_rgt'><b class=''></b></span>
    <div class="p_g_slider">
        <div class="p_g_sliderbox">
            <ul class='curr'>
                <?php foreach($goodGallery as $key=>$row){?>
                <?php if($key%5==0 && $key>0){?>
                </ul><ul>
                <?php }?>
                <li>
                    <a class="<?php if($key==1)echo 'active';?>" href="javascript:void(0);" rel="{gallery:'gal1',smallimage:'<?php echo $goodImagePath.'/'.$row;?>',largeimage:'<?php echo $goodImagePath.'/'.$row;?>'}">
                        <img src="<?php echo $goodImagePath.'/'.$row;?>" alt="">
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
<?php Yii::app()->clientScript->registerScript('good_gallery',"
    $('.jqzoom').jqzoom({
        zoomType: 'standard',
        zoomWidth: 500,
        zoomHeight: 400,
        position:'right',
        xOffset:20,
        yOffset:0,
        title: false,
        lens:true
    });
    $('.p_g_slider_lft').click(function(){
        var curUl=$('.p_g_slider ul.curr'),index=curUl.index();
        if(index > 0){
            curUl.removeClass('curr').prev('ul').addClass('curr');
            $('.p_g_sliderbox').animate({'margin-left':'-'+305*--index+'px'},'slow');
            if(index==0){
                $('.p_g_slider_lft').children().addClass('noctrl');
            }
            if(index<$('.p_g_slider ul').length-1){
                $('.p_g_slider_rgt').children().removeClass('noctrl');
            }
        }else{
            return false;
        }
    });
    $('.p_g_slider_rgt').click(function(){
        var curUl=$('.p_g_slider ul.curr'),index=curUl.index();
        if(index < $('.p_g_slider ul').length-1){
            curUl.removeClass('curr').next('ul').addClass('curr');
            $('.p_g_sliderbox').animate({'margin-left':'-'+305*++index+'px'},'slow');
            if(index == $('.p_g_slider ul').length-1){
                $('.p_g_slider_rgt').children().addClass('noctrl');
            }
            if(index>0){
                $('.p_g_slider_lft').children().removeClass('noctrl');
            }
        }else{
            return false;
        }
    });
",CClientScript::POS_END);?>
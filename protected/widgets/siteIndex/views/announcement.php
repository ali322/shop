<div class="announcement">
    <div class="mini_tabs">
        <h2 class='cur'>公告</h2>
        <h2>新闻</h2>
    </div>
    <div class="mini_tabs_contents">
        <div class="mini_tabs_content mini_tabs_on">
            <ul class="announcement_items">
                <li><a href="">千万商品免费领限时抢</a></li>
                <li><a href="">千万商品免费领限时抢</a></li>
                <li><a href="">千万商品免费领限时抢</a></li>
                <li><a href="">千万商品免费领限时抢</a></li>
                <li><a href="">千万商品免费领限时抢</a></li>
                <li class="more"><a href="">更多</a></li>
            </ul>
        </div>
        <div class="mini_tabs_content">
            <ul class="news_items">
                <li><a href="">300品牌大派券全场五折 </a></li>
                <li><a href="">300品牌大派券全场五折 </a></li>
                <li><a href="">300品牌大派券全场五折 </a></li>
                <li><a href="">300品牌大派券全场五折 </a></li>
                <li><a href="">300品牌大派券全场五折 </a></li>
                <li class="more"><a href="">更多</a></li>
            </ul>
        </div>
    </div>
</div>
<?php Yii::app()->clientScript->registerScript('announcement',"
$('.mini_tabs h2').mouseenter(function(){
    $(this).addClass('cur').siblings().removeClass('cur');
    $('.mini_tabs_content').eq($(this).index()).addClass('mini_tabs_on').siblings().removeClass('mini_tabs_on');
});
",CClientScript::POS_END); ?>
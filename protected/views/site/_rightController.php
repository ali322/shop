<div class="right_controller">
    <a class='user_investigation' href="javascript:void(0)"><b></b>问卷调查</a>
    <a href="javascript:void(0)"><b></b>返回顶部</a>
</div>
<?php Yii::app()->clientScript->registerScript('rightController',"
    (function() {
        var backToTopEle=$('.right_controller').click(function() {
            $('html, body').animate({ scrollTop: 0 }, 120);
        })
        var backToTopFun = function() {
            var st = $(document).scrollTop(), winh = $(window).height();
            (st > 0)? backToTopEle.show(): backToTopEle.hide();
            //IE6下的定位
            if (!window.XMLHttpRequest) {
                backToTopEle.css('top', st + winh -300);
            }
        };
    $(window).bind('scroll', backToTopFun);
    $(function() { backToTopFun(); });
})();
",CClientScript::POS_END); ?>
<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '所有评论',
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="list_wrap wrap clear">
    <div class="list_lft">
        <div class="list_lft_panel allcomments_good_panel">
            <h2>商品信息</h2>
            <div class="allcomments_good">
                <div class="allcomments_good_pic">
                    <a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/temp/good_thumb.jpg" alt=""></a>
                </div>
                <p class='allcomments_good_name'>诺基亚（Nokia）GSM手机 C5-05（黑红色）</p>
                <p class="allcomments_good_price">折扣价:<b>￥1000</b></p>
                <div class="allcomments_good_btn"><a href="" class='product_buy'></a></div>
            </div>
        </div>
    </div>
    <div class="list_rgt">
        <div class="allcomments_nav">
            <ul>
                <li class='curr'><a href="javascript:void(0)">全部评论(100)</a></li>
                <li><a href="javascript:void(0)">好评(20)</a></li>
                <li><a href="javascript:void(0)">中评(30)</a></li>
                <li><a href="javascript:void(0)">差评(5)</a></li>
            </ul>
        </div>
        <div class="allcomments_lists">
            <div class="allcomments_list">
                <div class="good_comment">
                    <div class="good_comment_user">
                        <div class="g_c_user_avatar">
                            <a href=""><img src="<?php echo Yii::app()->request->baseUrl;?>/images/temp/user_avatar.gif" alt=""></a>
                        </div>
                        <p class="g_c_user_name">
                        alichen
                        </p>
                        <p class='g_c_user_date'>购买日期<br />2012-08-13</p>
                    </div>
                    <div class="good_comment_content">
                        <div class="g_c_extra"></div>
                        <div class="g_c_content_title">
                            <span class='g_c_c_rank'><b class='rank_small_1'></b></span><span class='g_c_c_date'>2012-08-13 12:00:00</span>
                        </div>
                        <div class="g_c_content">
                            系统很好，操作起来方便简单快捷，没有出现过死机的现象
                        </div>
                        <div class="g_c_btn"><span>此评论对我</span><a href="javascript:void(0)">有用(1)</a><a href="javascript:void(0)">没用(0)</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
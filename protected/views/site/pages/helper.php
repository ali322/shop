<div class="list_breadcrumbs wrap">
    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
        'homeLink'=>'首页',
        'links'=>array(
            '帮助中心',
        ),
    )); ?><!-- breadcrumbs -->
</div>
<div class="wrap list_wrap clear">
    <div class="list_lft">
        <?php $this->renderPartial('pages/menu');?>
    </div>
    <div class="list_rgt">
        <dl class="help_category">
            <dt><b>新手入门</b></dt>
            <dd>
                <ul>
                    <li><a href="">新手注册</a></li>
                    <li><a href="">用户登录</a></li>
                    <li><a href="">邮箱验证</a></li>
                </ul>
            </dd>
            <dt><b>新手入门</b></dt>
            <dd>
                <ul>
                    <li><a href="">新手注册</a></li>
                    <li><a href="">用户登录</a></li>
                    <li><a href="">邮箱验证</a></li>
                </ul>
            </dd>
        </dl>
    </div>
</div>
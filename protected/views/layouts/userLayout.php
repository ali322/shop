<?php $this->beginContent('//layouts/mainLayout'); ?>
<div class='list_breadcrumbs wrap'>
<?php $this->widget('zii.widgets.CBreadcrumbs', array(
    'links'=>array(
        $this->breadcrumbs
    ),
)); ?><!-- breadcrumbs -->
</div>
<div class="user_wrap wrap clear">
    <div class="user_lft">
        <div class="lft_bar">
            <h3><?php echo UserModule::t('Your trade'); ?></h3>
            <ul class="actions">
                <li><?php echo CHtml::link(UserModule::t('Order'),array('/user/order')); ?></li>
                <li><?php echo CHtml::link(UserModule::t('Good Conllect'),array('/user/collect')); ?></li>
                <li><?php echo CHtml::link(UserModule::t('Good Qa'),array('/user/posts')); ?></li>
                <li><?php echo CHtml::link(UserModule::t('Good Comment'),array('/user/comments')); ?></li>
            </ul>
        </div>

        <div class="lft_bar">
            <h3><?php echo UserModule::t('Your profile'); ?></h3>
            <ul class="actions">
                <?php
                if(UserModule::isAdmin()) {
                    ?>
                    <li><?php echo CHtml::link(UserModule::t('Manage User'),array('/user/admin')); ?></li>
                    <?php
                }
                ?>
                <li><?php echo CHtml::link(UserModule::t('Profile'),array('/user/profile')); ?></li>
                <li><?php echo CHtml::link(UserModule::t('Edit'),array('/user/profile/edit')); ?></li>
                <li><?php echo CHtml::link(UserModule::t('Delivery'),array('/user/delivery')); ?></li>
                <?php if(Yii::app()->user->getState('oauth_type') == null){?>
                <li><?php echo CHtml::link(UserModule::t('Change password'),array('/user/profile/changepassword')); ?></li>
                <?php }?>
                <li><?php echo CHtml::link(UserModule::t('Logout'),array('/user/logout')); ?></li>
            </ul>
        </div>
        <div class="user_lft_footer"></div>
    </div>
    <div class="user_rgt">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>
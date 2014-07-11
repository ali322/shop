<?php if(isset($authorized)){
    echo CHtml::script('top.location.reload()');
    Yii::app()->end();
}?>
<div class="minlogin_content">
    <div class="form user_box">
        <?php echo CHtml::beginForm(); ?>
        <div class="row">
            <?php echo CHtml::activeLabelEx($model,'username'); ?>
            <div class="row_input">
                <?php echo CHtml::activeTextField($model,'username') ?>
                <?php echo CHtml::error($model,'username');?>
            </div>
        </div>

        <div class="row">
            <?php echo CHtml::activeLabelEx($model,'password'); ?>
            <div class="row_input">
                <?php echo CHtml::activePasswordField($model,'password') ?>
                <?php echo CHtml::error($model,'password');?>
            </div>
        </div>
        <div class="row rememberMe">
            <?php echo CHtml::activeCheckBox($model,'rememberMe'); ?>
            <?php echo CHtml::activeLabelEx($model,'rememberMe'); ?>
        </div>

        <div class="row submit login_submit">
            <?php echo CHtml::submitButton(UserModule::t("Login")); ?><?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
        </div>

        <?php echo CHtml::endForm(); ?>
    </div><!-- form -->
</div>
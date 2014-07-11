<?php
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Login");
?>
<div class="login_box">
    <h1><?php echo UserModule::t("Login"); ?></h1>
    <div class="login_inner_box">
        <div class="login_lft_box"><!--右边框开始-->
<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>
<?php endif; ?>
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
        <button type='submit'><?php echo UserModule::t("Login"); ?></button><?php echo CHtml::link(UserModule::t("Lost Password?"),Yii::app()->getModule('user')->recoveryUrl); ?>
	</div>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->
 </div><!--右边框结束-->
    <div class="login_rgt_box">
        <div class="login_rgt_inner_box">
        <p><strong>您还不是友谊阿波罗网上商城会员吗？</strong></p>
        <p>现在免费注册成为1号店用户，不出家门就能享受更多的优惠哦！</p>
        <p class="l_r_b_reg"><?php echo CHtml::link(UserModule::t("Register"),Yii::app()->getModule('user')->registrationUrl); ?></p>
        </div>
    </div>
    </div>
</div>

<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>

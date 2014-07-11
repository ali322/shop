<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");?>
<div class="profile_edit_wrap">
<div class="form user_box">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'changepassword-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
	    <?php echo $form->labelEx($model,'password'); ?>
        <div class="row_input">
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
        <div class="hint">
        <?php echo UserModule::t("Minimal password length 4 symbols."); ?>
        </div>
        </div>
	</div>
	
	<div class="row">
	    <?php echo $form->labelEx($model,'verifyPassword'); ?>
        <div class="row_input">
        <?php echo $form->passwordField($model,'verifyPassword'); ?>
        <?php echo $form->error($model,'verifyPassword'); ?>
        </div>
	</div>
	
	
	<div class="row submit login_submit profile_submit">
	<?php echo CHtml::submitButton(UserModule::t("Save")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
</div>
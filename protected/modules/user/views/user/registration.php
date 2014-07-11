<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");
?>
<div class="login_box">
    <h1><?php echo UserModule::t("Registration"); ?></h1>
    <div class="login_inner_box reg_form_box"><!--右边框开始-->
<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form user_box">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<div class="row">
    	<?php echo $form->labelEx($model,'username'); ?>
        <div class="row_input">
        <?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
        </div>
	</div>
	
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
	
	<div class="row">
	    <?php echo $form->labelEx($model,'email'); ?>
        <div class="row_input">
	    <?php echo $form->textField($model,'email'); ?>
	    <?php echo $form->error($model,'email'); ?>
        </div>
	</div>
	
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname); ?>
        <div class="row_input">
		<?php 
		if ($field->widgetEdit($profile)) {
			echo $field->widgetEdit($profile);
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
        </div>
	</div>	
			<?php
			}
		}
?>
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row verify_row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
        <div class="row_input">
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
        <div class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?></div>
        </div>
        <div class="verify_img">
            <?php $this->widget('CCaptcha'); ?>
        </div>
	</div>
	<?php endif; ?>
	<div class="row rememberMe">
             <?php echo CHtml::checkBox('agree_serv');?><label>&nbsp;已阅读并且同意<a href="">友阿奥特莱斯网购协议</a></label>
        </div>
	<div class="row submit login_submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>
    </div><!--右边框结束-->
</div>
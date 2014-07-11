<div class="form user_box">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'qa-posts-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo UserModule::t("<p class='note'>Fields with <span class='required'>*</span> are required.</p>")?>

	<?php echo $form->errorSummary($model); ?>

  	<div class="row qacates">
		<?php echo $form->labelEx($model,'cat_id'); ?>
		<?php echo $form->radioButtonList($model,'cat_id',QaPosts::getCates(),array(
                    'separator'=>'',
                    'labelOptions'=>array('class'=>'post_type_radio')
                ))?>
        <?php echo $form->error($model,'cat_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'content',array('class'=>'content_label')); ?>
        <div class="row_input">
        <?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
        </div>
	</div>


	<div class="row buttons submit login_submit profile_submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '保存',array('class'=>'submit_btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
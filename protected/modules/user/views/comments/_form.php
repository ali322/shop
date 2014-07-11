<div class="form user_box">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'qa-comments-form',
	'enableAjaxValidation'=>false,
)); ?>

    <h1><?php echo $model->isNewRecord ? UserModule::t("Create Comment") : UserModule::t("Modify Comment") ?></h1>
    <div class="row">
        <?php echo $form->labelEx($model,'rank'); ?>
        <div class="row_input rank_input">
            <?php $this->widget('CStarRating',array(
        //    'model'=>$model,
            'value'=>$model->rank,
            'name'=>'rank',
            'maxRating'=>5,
            'cssFile'=>false
            )); ?>
            <?php echo $form->error($model,'rank'); ?>
        </div>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'content',array('class'=>'content_label')); ?>
        <div class="row_input">
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
        </div>
	</div>


	<div class="row buttons submit login_submit profile_submit">
        <?php echo CHtml::hiddenField('goodId',$good['good_id']); ?>
        <?php echo CHtml::hiddenField('uniqueGood',$good['unique']); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t("Create") : UserModule::t("Save"),array('class'=>'submit_btn')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
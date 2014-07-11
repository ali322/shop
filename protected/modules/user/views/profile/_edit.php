<div class="profile_edit_wrap">
<?php if(Yii::app()->user->hasFlash('mineMessage')): ?>
    <div class="success">
        <?php echo Yii::app()->user->getFlash('mineMessage'); ?>
    </div>
    <?php endif; ?>
    <div class="form user_box">
        <?php $form=$this->beginWidget('UActiveForm', array(
        'id'=>'mine-form',
        'enableAjaxValidation'=>true,
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
    )); ?>

        <p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

        <?php echo $form->errorSummary(array($model,$profile)); ?>

        <?php
        $profileFields=$profile->getFields();
        if ($profileFields) {
            foreach($profileFields as $field) {
                ?>
                <div class="row">
                    <?php echo $form->labelEx($profile,$field->varname);?>
                    <div class="row_input">
                    <?php
                    if ($field->widgetEdit($profile)) {
                        echo $field->widgetEdit($profile);
                    } elseif ($field->range) {
                        echo $form->dropDownList($profile,$field->varname,profile::range($field->range));
                    } elseif ($field->field_type=="TEXT") {
                        echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
                    } else {
                        echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
                    }
                    echo $form->error($profile,$field->varname); ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <?php if(Yii::app()->user->getState('oauth_type') == null){?>
        <div class="row">
            <?php echo $form->labelEx($model,'username'); ?>
            <div class="row_input">
            <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20,'readonly'=>true)); ?>
            <?php echo $form->error($model,'username'); ?>
            </div>
        </div>
        <?php }?>
        <div class="row">
            <?php echo $form->labelEx($model,'email'); ?>
            <div class="row_input">
            <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
            <?php echo $form->error($model,'email'); ?>
            </div>
        </div>

        <div class="row buttons submit login_submit profile_submit">
            <?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div><!-- form -->
</div>
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'delivery-form',
    //  'action'=>Yii::app()->createUrl('user/delivery/create'),
    'enableAjaxValidation'=>false,
)); ?>
    <h3 class='address_h3'>新增收货地址<b>(请填写真实信息)</b></h3>
    <dl>
        <dd>
            <?php echo $form->labelEx($model,'consignee'); ?>
            <?php echo $form->textField($model,'consignee'); ?>
            <span class='address_error delivery_error'><?php echo $form->error($model,'consignee'); ?></span>
        </dd>
        <dd><label>收货地址:</label>
            <span class='address_selector'>
            <?php $this->widget('ext.addressSelector.AddressSelector',array(
                'address'=>array(
                    'province_id'=>$model->province_id,
                    'city_id'=>$model->city_id,
                    'zone_id'=>$model->zone_id,
                ),
            ));?>
            </span>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'address'); ?>
            <?php echo $form->textField($model,'address'); ?>
            <span class='address_error delivery_error'><?php echo $form->error($model,'address'); ?></span>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'zipcode'); ?>
            <?php echo $form->textField($model,'zipcode'); ?>
            <span class='address_error delivery_error'><?php echo $form->error($model,'zipcode'); ?></span>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone'); ?>
            <span class='address_error delivery_error'><?php echo $form->error($model,'phone'); ?></span>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'ext'); ?>
            <?php echo $form->textField($model,'ext'); ?>
            <span class='address_error delivery_error'><?php echo $form->error($model,'ext'); ?></span>
        </dd>
        <dd class='address_default rememberMe'>
            <?php echo $form->checkBox($model,'is_default',array('uncheckValue'=>null)); ?>
            <?php echo $form->labelEx($model,'is_default'); ?>
        </dd>
    </dl>
    <?php $this->endWidget(); ?>
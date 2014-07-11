<h3 class='address_h3'>现在的收货地址<b>(最多保存5个地址)</b></h3>
<ul class='address_list'>
    <?php if($userDeliverys){?>
    <?php foreach($userDeliverys as $userDelivery){?>
    <li>
        <span>
            <?php echo $userDelivery->consignee;?>,&nbsp;
            <?php echo $userDelivery->formatedProvince;?>,&nbsp;
            <?php echo $userDelivery->formatedCity;?>,&nbsp;
            <?php echo $userDelivery->formatedZone;?>,&nbsp;
            <?php echo $userDelivery->address;?>,&nbsp;
            <?php echo $userDelivery->zipcode;?>,&nbsp;
            <?php echo $userDelivery->phone;?>,&nbsp;
            <?php echo $userDelivery->ext;?>,
            <?php if($userDelivery->is_default){?>
            <b><?php echo Yii::t('core','Default Delivery');?></b>
            <?php }?>
        </span>
        <span class='address_opt'>
            <a href="<?php echo Yii::app()->createUrl('user/delivery/update',array('id'=>$userDelivery->id));?>"><?php echo Yii::t('core','Edit');?></a>
            <a href="<?php echo Yii::app()->createUrl('user/delivery/delete',array('id'=>$userDelivery->id));?>"><?php echo Yii::t('core','Delete');?></a>
            <a href="<?php echo Yii::app()->createUrl('user/delivery/setdefault',array('id'=>$userDelivery->id));?>">
                <?php if($userDelivery->is_default){echo Yii::t('core','Cancel');}else{echo Yii::t('core','Is Default');}?>
            </a>
        </span>
    </li>
    <?php }}else{?>
    <li><span>无</span></li>
    <?php }?>
</ul>
<div class="address_form user_box">
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
            <span class='address_error'><?php echo $form->error($model,'consignee'); ?></span>
        </dd>
        <dd>
            <label>收货地址:</label>
            <?php $this->widget('ext.addressSelector.AddressSelector',array(
                'address'=>array(
                  'province_id'=>$model->province_id,
                  'city_id'=>$model->city_id,
                  'zone_id'=>$model->zone_id,
                ),
            ));?>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'address'); ?>
            <?php echo $form->textField($model,'address'); ?>
            <span class='address_error'><?php echo $form->error($model,'address'); ?></span>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'zipcode'); ?>
            <?php echo $form->textField($model,'zipcode'); ?>
            <span class='address_error'><?php echo $form->error($model,'zipcode'); ?></span>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'phone'); ?>
            <?php echo $form->textField($model,'phone'); ?>
            <span class='address_error'><?php echo $form->error($model,'phone'); ?></span>
        </dd>
        <dd>
            <?php echo $form->labelEx($model,'ext'); ?>
            <?php echo $form->textField($model,'ext'); ?>
            <span class='address_error'><?php echo $form->error($model,'ext'); ?></span>
        </dd>
        <dd class='address_default rememberMe'>
            <?php echo $form->checkBox($model,'is_default',array('uncheckValue'=>null)); ?>
            <?php echo $form->labelEx($model,'is_default'); ?>
        </dd>
        <dd class='address_button login_submit'>
            <?php echo CHtml::submitButton(Yii::t('core','Save'));?>
        </dd>
    </dl>
    <?php $this->endWidget(); ?>
</div>
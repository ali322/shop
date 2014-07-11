<span class='address_selector'>
   <select name="UserDelivery[province_id]" class='province_selector'>
       <option value="0">请选择省份</option>
       <?php foreach($provinces as $province){ ?>
       <?php if($this->address['province_id'] == $province['province_id']){ ?>
       <option value="<?php echo $province['province_id'];?>" selected='selected'><?php echo $province['province_name'];?></option>
       <?php }else{ ?>
       <option value="<?php echo $province['province_id'];?>"><?php echo $province['province_name'];?></option>
       <?php }?>
       <?php }?>
   </select>
   <select name="UserDelivery[city_id]" class='city_selector'>
       <option value="0">请选择市/区</option>
       <?php
       if($cities){
       foreach($cities as $city){
       if($this->address['city_id'] == $city['city_id']){
       ?>
       <option value="<?php echo $city['city_id'];?>" selected='selected'><?php echo $city['city_name'];?></option>
       <?php }else{?>
       <option value="<?php echo $city['city_id'];?>"><?php echo $city['city_name'];?></option>
       <?php }}}?>
   </select>
   <select name="UserDelivery[zone_id]" class='zone_selector'>
       <option value="0">请选择区/县/街道</option>
       <?php
       if($zones){
       foreach($zones as $zone){
       if($this->address['zone_id'] == $zone['zone_id']){
       ?>
       <option value="<?php echo $zone['zone_id'];?>" selected='selected'><?php echo $zone['zone_name'];?></option>
       <?php }else{?>
       <option value="<?php echo $zone['zone_id'];?>"><?php echo $zone['zone_name'];?></option>
       <?php }}}?>
   </select>
</span>
<?php Yii::app()->clientScript->registerScript('address_selector',"
    $('.province_selector').live('change',function(){
        var provinceId=$(this).attr('value');
        if(provinceId>0){
            $.post('".Yii::app()->createUrl('main/dynamicAddress')."',{provinceId:provinceId},function(data){
                $('.city_selector').html(' <option value=\"0\">请选择市/区</option>');
                for(i=0;i<data.length;i++){
                    $('<option value=\"'+data[i].city_id+'\">'+data[i].city_name+'</option>').appendTo('.city_selector');
                }
            },'json');
        }else{
            return false;
        }
    });
    $('.city_selector').live('change',function(){
        var cityId=$(this).attr('value');
        if(cityId>0){
            $.post('".Yii::app()->createUrl('main/dynamicAddress')."',{cityId:cityId},function(data){
                $('.zone_selector').html('<option value=\"0\">请选择区/县/街道</option>');
                for(i=0;i<data.length;i++){
                    $('<option value=\"'+data[i].zone_id+'\">'+data[i].zone_name+'</option>').appendTo('.zone_selector');
                }
            },'json');
        }else{
            return false;
        }
    });
",CClientScript::POS_BEGIN);?>
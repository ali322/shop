<div class="collects_wrap orders_wrap comment_wrap">
    <div class="orders_query">
        <div class="orders_select">
            <select name="" id="">
                <option value="">近一个月</option>
                <option value="">近一个星期</option>
            </select>
        </div>
        <div class="orders_query_form">
            <form action="">
                <input type="text" class='text'/>
                <button type='submit' class='orders_query_submit'>查询</button>
            </form>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th width='10%'>商品图片</th>
            <th width='50%'>商品名称</th>
            <th width='20%'>购买时间</th>
            <th width='12%'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($goods as $good){ ?>
        <tr>
            <td class='collect_good_img'><a href=""><img src="<?php echo $good['goodImageUrl'].'/'.$good['good_thumb'];?>" alt=""></a></td>
            <td style='text-align:left'>
                <h5>订单号:&nbsp;<?php echo $good['order_sn']; ?></h5>
                <a href=""><?php echo $good['good_name'] ?></a>
            </td>
            <td class='collect_good_price'><?php echo date('Y年m月d日 H:i:s',$good['buy_time']); ?></td>
            <td class='collect_btn'>
                <ul>
                    <?php if($good['isCommented']){ ?>
                    <li>
                        <?php echo CHtml::beginForm($this->createUrl('comments/update',array('id'=>$good['unique']))); ?>
                        <?php echo CHtml::hiddenField('good',CJSON::encode($good)); ?>
                        <button type='submit'><?php echo UserModule::t('Modify'); ?></button>
                        <?php echo CHtml::endForm(); ?>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <?php echo CHtml::beginForm($this->createUrl('comments/create')); ?>
                        <?php echo CHtml::hiddenField('good',CJSON::encode($good)); ?>
                        <button type='submit'><?php echo UserModule::t('Comment'); ?></button>
                        <?php echo CHtml::endForm(); ?>
                    </li>
                    <?php } ?>
                </ul>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
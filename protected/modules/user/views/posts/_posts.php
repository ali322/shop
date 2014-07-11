<div class="orders_wrap posts_wrap">
    <div class="orders_query">
        <div class="orders_select posts_btn">
            <a href='' target='_blank'><b></b>发布</a>
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
            <th width='10%'>咨询分类</th>
            <th width='50%'>咨询问题</th>
            <th width='20%'>咨询时间</th>
            <th width='14%'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($posts as $post){ ?>
        <tr>
            <td><?php echo $post->cat_id; ?></td>
            <td style='text-align:left'><?php echo $post->content; ?></td>
            <td><?php echo $post->add_time; ?></td>
            <td class='order_btn'><a href="<?php echo Yii::app()->createUrl('user/posts/view',array('id'=>$post->id)); ?>">查看</a></td>
        </tr>
            <?php }?>
        </tbody>
    </table>
    <div class="orders_pager list_goods_pager">
        <div class="pager">
            <?php $this->widget('CLinkPager',array(
            'pages'=>$pager,
            'header'=>'&nbsp',
            'cssFile'=>false
        ))?>
        </div>
    </div>
</div>
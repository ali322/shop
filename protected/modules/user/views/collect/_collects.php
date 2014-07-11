<div class="collects_wrap orders_wrap">
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
            <th width='5%'><input type="checkbox" /></th>
            <th width='20%'>商品图片</th>
            <th width='50%'>商品名称</th>
            <th width='10%'>商品价格</th>
            <th width='12%'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($goods as $good){ ?>
        <tr>
            <td><input type="checkbox" /></td>
            <td class='collect_good_img'><a href=""><img src="<?php echo $good->goodDetail->getImageUrl().'/'.$good->goodDetail->good_img;?>" alt=""></a></td>
            <td style='text-align:left'><a href=""><?php echo $good->good_name; ?></a></td>
            <td class='collect_good_price'>￥<?php echo $good->shop_price; ?></td>
            <td class='collect_btn'>
                <ul>
                    <li><button type='button'>购买</button></li>
                    <li><a href="">取消收藏</a></li>
                </ul>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
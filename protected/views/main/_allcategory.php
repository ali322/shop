<ul class="top_category">
    <?php foreach($catArr as $navCatKey=>$navCat){ ?>
    <li class='<?php echo $navCatKey==0?'curr':'';?>'>
        <a href="#category_<?php echo $navCat['id']; ?>"><?php echo $navCat['text']; ?></a>
    </li>
    <?php } ?>
</ul>
<div class="category_list">
    <?php foreach($catArr as $topCat){ ?>
    <div class="category_list_panel" id='category_<?php echo $topCat['id']; ?>'>
        <h2><b><?php echo $topCat['text']; ?></b></h2>
        <?php foreach($topCat['children'] as $secondCatKey=>$secondCat){ ?>
        <dl class='<?php echo $secondCatKey==0?'first':'';?>'>
            <dt><a href=""><?php echo $secondCat['text']; ?></a></dt>
            <dd>
                <?php foreach($secondCat['children'] as $lastCat){ ?>
                <a href="<?php echo $lastCat['href'];?>" target='_blank'><?php echo $lastCat['text']; ?></a>
                <?php }?>
            </dd>
        </dl>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<ul>
    <?php foreach($pageNavItems as $key=>$pageNavItem){?>
    <?php if(isset($pageNavItem['active']) && $pageNavItem['active'] == true){?>
    <li class='active'><a href="<?php echo $pageNavItem['url'];?>"><?php echo $pageNavItem['label'];?></a></li>
    <?php }else{?>
    <li><a href="<?php echo $pageNavItem['url'];?>"><?php echo $pageNavItem['label'];?></a></li>
    <?php }}?>
</ul>
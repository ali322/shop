<?php foreach($goodSpecs as $specName=>$specValues){?>
<dl class='product_spec'>
    <dt alt='<?php echo $specName;?>'><?php echo substr($specName,strpos($specName,'_')+1);?>:</dt>
    <dd>
        <ul>
            <?php foreach($specValues as $specValue){?>
            <li class='<?php if($specValue==$defaultProduct['spec_values'][$specName])echo 'selected';?>'><span><?php echo $specValue;?></span><b></b></li>
            <?php }?>
        </ul>
    </dd>
</dl>
<?php }?>
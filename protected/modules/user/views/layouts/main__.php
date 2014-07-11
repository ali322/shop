<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"	/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/msg.css"	/>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/webshop.css"	/>
	<!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /-->
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<div class="main_container">
<div class="main_header">
<a href="<?php echo Yii::app()->createUrl("site/index");?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.jpg" border='0' alt="" class="outlets_logo" /></a>
<ul class="top_href">
	<li><a href='' target='blank'></a></li>
	<li><a href='<?php echo Yii::app()->createUrl("acts/index");?>' target='blank'></a></li>
	<li><a href='<?php echo Yii::app()->createUrl("acts/index");?>' target='blank'></a></li>
</ul>
<div class="clear"></div>
<ul class="top_btn">
	<li><a href='' target='blank'><!--img src="images/icons/login.jpg" alt="" /--></a></li>
	<li><a href='' target='blank'><!--img src="images/icons/reg.jpg" alt="" /--></a></li>
</ul>
<div class="ccb_ad"><a href='http://www.9448.net/newjrdshop' target='_blank'></a></div>
<div class="clear"></div>
<ul class="top_nav">
	<li><a class='top_nav_a' href='<?php echo Yii::app()->createUrl("site/page",array("view"=>"about.about_outlets"));?>' target='_blank'></a></li>
	<li><a class='top_nav_a'  href='<?php echo Yii::app()->createUrl("shine/index");?>' target='_blank'></a></li>
	<li><a class='top_nav_a'  href='<?php echo Yii::app()->createUrl("brand/index");?>' target='_blank'></a></li>
	<li><a class='top_nav_a'  href='<?php echo Yii::app()->createUrl("site/page",array("view"=>"trafic.drive"));?>' target='_blank'></a></li>
	<li><a class='top_nav_a'  style='width:132px;' href='http://www.9448.net/newjrdshop' target='_blank'></a></li>
	<li><a class='top_nav_a'  href='<?php echo Yii::app()->createUrl("shop");?>' target='_blank'></a></li>
	<li><a class='top_nav_a'  href='<?php echo Yii::app()->createUrl("site/page",array("view"=>"service"));?>' target='_blank'></a></li>
</ul>
</div>
<div class="main_content">
<?php echo $content;?>
</div>
<div class="main_footer main_footer_">
    <span class='copy_rights'>&copy;友阿奥特莱斯版权所有<br />增值电信业务经营许可证：湘B-2-4-20060060&nbsp;ICP备案号：湘ICP备05020822号</span>
<span class='footer_nav'>
<dl>
	<dd>
		<a href="http://weibo.com/yaoutlets"  target='_blank'>友阿奥莱官方微博</a>
	</dd>
	<dd>
		<a href="<?php echo Yii::app()->createUrl("site/page",array("view"=>"service"));?>" target='_blank'>联系我们</a>
	</dd>
	<dd>
		<a href="<?php echo Yii::app()->createUrl("site/page",array("view"=>"about.invest"));?>" target='_blank'>加入我们</a>
	</dd>
	<dd>
		<a href="" target='_blank'>网站地图</a>
	</dd>
	<dd>
		<a href="" target='_blank'>隐私条例</a>
	</dd>
</dl>
</span>
<div class="clear"></div>
</div>
</div>
</body>
</html>

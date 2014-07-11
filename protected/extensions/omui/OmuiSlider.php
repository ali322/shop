<?php
Yii::import('ext.omui.OmuiWidget');
class OmuiSlider extends OmuiWidget{
    /*面板标签(包含所有帧)*/
    public $sliderId;
    /*导航条标签*/
    public $navId; //设置是否需要导航条，当属性值为String的时候表示使用内置的导航条类型， 当属性值为Selector的时候表示使用自定义的导航条，当属性值设置为true的时候默认使用内置的"classical"导航条。 内置的导航条类型包括"classical"，"dot"。
    /*om-slider配置选项*/
    public $options=array();
    
    public function init(){
        parent::init();
        $this->loadPlugin('slider');
    }
    
    public function run(){
        $defaultOptions=array(
        'autoPlay'=>true, //设置面板是否自动切换
        'animSpeed'=>200, //动画执行的速度。单位毫秒，值越小动画执行的速度越快
        'activeNavCls'=>'nav-selected', //设置导航条选中的时候设置的class样式，同时作用于内置导航条和自定义导航条
        'delay'=>200, //鼠标移动到导航条上面后触发切换动作的延迟时间。单位为毫秒
        'directionNavHide'=>true, //设置是否需要鼠标放上去显示用来切换上一个或下一个面板的方向导航键。
        'directionNav'=>false, //设置是否需要显示用来切换上一个或下一个面板的方向导航键（设为true时把鼠标移动到slider上面的时候会出现一个悬浮的上一个或下一个的工具条）。
        'effect'=>'fade', //设置面板切换的动画效果。 内置的动画效果包括'fade'(淡入淡出)、'slide-v'(垂直滑动)、'slide-h'(水平滑动)、'random'(随机动画)。 设置为true使用默认'fade'动画效果，设置为false不使用动画效果。
        'interval'=>5000, //自动切换间隔时间，只有当autoPlay为true的时候这个属性才有效(单位:毫秒)
        'pauseOnHover'=>true, //设置当鼠标移动到slider上面的时候是否暂停自动切换
        'startSlide'=>0 //组件初始化时默认激活的面板的index，index从0开始计算，0表示第一个面板
        );
        
        $options=array_merge($defaultOptions,array('controlNav'=>$this->navId),$this->options);
        $options=CJavaScript::encode($options);
        /*
        $_options='';
        foreach($options as $k=>$v){
            if(is_string($v))
                $_options.="{$k}:'{$v}',";
            elseif(is_bool($v))
                $_options.="{$k}:'{$v}',";
            else
                $_options.="{$k}:{$v},";
        }
         */
        if(!$this->cs->isScriptRegistered(__CLASS__.$this->sliderId))
        $this->cs->registerScript(__CLASS__.$this->sliderId,"
            $('#{$this->sliderId}').omSlider($options);
        ",CClientScript::POS_READY);
    }
}
?>

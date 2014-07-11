<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alichen
 * Date: 12-7-26
 * Time: 上午11:15
 * To change this template use File | Settings | File Templates.
 */
Yii::import('zii.widgets.CListView');
class EListView extends CListView{
    public function renderSorter(){
        if($this->dataProvider->getItemCount()<=0 || !$this->enableSorting || empty($this->sortableAttributes))
            return;
        echo CHtml::openTag('div',array('class'=>$this->sorterCssClass))."\n";
        echo "<dl>\n";
        echo "<dt>";
        echo $this->sorterHeader===null ? Yii::t('zii','Sort by: ') : $this->sorterHeader;
        echo "</dt>\n";
        $sort=$this->dataProvider->getSort();
        foreach($this->sortableAttributes as $name=>$label)
        {
            echo "<dd>";
            if(is_integer($name))
                echo $sort->link($label);
            else
                echo $sort->link($name,$label);
            echo "</dd>\n";
        }
        echo "</dl>";
        echo $this->sorterFooter;
        echo CHtml::closeTag('div');
    }
    public function renderMiniPager(){
        if(!$this->enablePagination)
            return;

        $pager=array();
        $class='CLinkPager';
        if(is_string($this->pager))
            $class=$this->pager;
        else if(is_array($this->pager))
        {
            $pager=$this->pager;
            if(isset($pager['class']))
            {
                $class=$pager['class'];
                unset($pager['class']);
            }
        }
        $pager['maxButtonCount']=0;
        $pager['header']='&nbsp';
        $pager['pages']=$this->dataProvider->getPagination();
        $pager['cssFile']=false;
        if($pager['pages']->getPageCount()>1)
        {
            echo '<div class="'.$this->pagerCssClass.'">';
            $this->widget($class,$pager);
            echo '</div>';
        }
        else
            $this->widget($class,$pager);
    }
}
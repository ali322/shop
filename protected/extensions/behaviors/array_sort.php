<?php
class array_sort extends  CActiveRecordBehavior{

public  $db;
//private $db_;
public  $table;
public  $cat_id;
public $cat_name;


public function __construct(){
		//$this->db= $this->owner->getDbConnection();
}


function addsort($cat_id,$CategoryID)
{
/*if($CategoryID==0){
    $lft=0;
    $rgt=1;
    }else{
 */
    $Result=$this->checkCategory($CategoryID);
    //取得父类的左值,右值
    $lft=$Result['lft'];
    $rgt=$Result['rgt'];
  //  CVarDumper::dump($lft);exit;
    $this->db->createCommand("UPDATE `".$this->table."` SET `lft`=`lft`+2 WHERE `lft`>".$rgt)->execute();
    $this->db->createCommand("UPDATE `".$this->table."` SET `rgt`=`rgt`+2 WHERE `rgt`>=".$rgt)->execute();
//    }

//插入
if($this->db->createCommand("UPDATE `".$this->table."` SET `lft`='$rgt',`rgt`='$rgt'+1 WHERE `cat_id`='$cat_id'")->execute()){
    //$this->referto("成功增加新的类别","JAVASCRIPT:HISTORY.BACK(1)",3);
    return true;
    }else{
    //$this->referto("增加新的类别失败了","JAVASCRIPT:HISTORY.BACK(1)",3);
    return false;
    }
} // end func 
	

function deletesort($CategoryID)
{
//取得被删除类别的左右值,检测是否有子类,如果有就一起删除
$Result=$this->checkCategory($CategoryID);
$lft=$Result['lft'];
$rgt=$Result['rgt'];
//执行删除
if($this->db->createCommand("DELETE FROM `".$this->table."` WHERE `lft`>=$lft AND `rgt`<=$rgt")->execute()){
    $Value=$rgt-$lft+1;
    //更新左右值
    $this->db->createCommand("UPDATE `".$this->table."` SET `lft`=`lft`-$Value WHERE `lft`>$lft")->execute();
    $this->db->createCommand("UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value WHERE `rgt`>$rgt")->execute();
    //$this->referto("成功删除类别","javascript:history.back(1)",3);
    return true;
    }else{
    //$this->referto("删除类别失败了","javascript:history.back(1)",3);
    return false;
    }
} // end func

/**
    * Short description. 
    * 1,所有子类,不包含自己;2包含自己的所有子类;3不包含自己所有父类4;包含自己所有父类
    * Detail description
    * @param         none
    * @global         none
    * @since         1.0
    * @access         private
    * @return         void
    * @update         date time
*/
function getCategory($CategoryID,$type=1)
{
$Result=$this->checkCategory($CategoryID);
$lft=$Result['lft'];
$rgt=$Result['rgt'];
$SeekSQL="SELECT * FROM `".$this->table."` WHERE ";
switch ($type) {
     case "1":
    $condition="`lft`>$lft AND `rgt`<$rgt";
    break;
    case "2":
    $condition="`lft`>=$lft AND `rgt`<=$rgt";
    break;
     case "3":
         $condition="`lft`<$lft AND `rgt`>$rgt";
         break; 
    case "4":
    $condition="`lft`<=$lft AND `rgt`>=$rgt";
    break;
    default :
    $condition="`lft`>$lft AND `rgt`<$rgt";
    ;
    } 
$SeekSQL.=$condition." ORDER BY `lft` ASC";
$Sorts=$this->db->createCommand($SeekSQL)->queryAll();
return $Sorts;
} // end func

/**
    * Short description. 
    * 取得直属父类
    * Detail description
    * @param         none
    * @global         none
    * @since         1.0
    * @access         private
    * @return         void
    * @update         date time
*/
function getparent($CategoryID)
{
$Parent=$this->getCategory($CategoryID,3);
return $Parent;
} // end func

/**
    * Short description. 
    * 移动类,如果类有子类也一并移动
    * Detail description
    * @param         none
    * @global         none
    * @since         1.0
    * @access         private
    * @return         void
    * @update         date time
*/
function moveCategory($SelfCategoryID,$ParentCategoryID)
{
$SelfCategory=$this->checkCategory($SelfCategoryID);
$NewCategory=$this->checkCategory($ParentCategoryID);


$Selflft=$SelfCategory['lft'];
$Selfrgt=$SelfCategory['rgt'];
$Value=$Selfrgt-$Selflft;
//取得所有分类的ID方便更新左右值
$CategoryIDS=$this->getCategory($SelfCategoryID,2);
foreach($CategoryIDS as $v){
    $IDS[]=$v[$this->cat_id];
    }
$InIDS=implode(",",$IDS);


$Parentlft=$NewCategory['lft'];
$Parentrgt=$NewCategory['rgt'];
//print_r($InIDS);
//print_r($NewCategory);
//print_r($SelfCategory);
//exit;
if($Parentrgt>$Selfrgt){
    $UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$Value-1 WHERE `lft`>$Selfrgt AND `rgt`<=$Parentrgt";
    $UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`-$Value-1 WHERE `rgt`>$Selfrgt AND `rgt`<$Parentrgt";
    $TmpValue=$Parentrgt-$Selfrgt-1;
    $UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$TmpValue,`rgt`=`rgt`+$TmpValue WHERE `".$this->cat_id."` IN($InIDS)";
    }else{
    $UpdateLeftSQL="UPDATE `".$this->table."` SET `lft`=`lft`+$Value+1 WHERE `lft`>$Parentrgt AND `lft`<$Selflft";
    $UpdateRightSQL="UPDATE `".$this->table."` SET `rgt`=`rgt`+$Value+1 WHERE `rgt`>=$Parentrgt AND `rgt`<$Selflft";
    $TmpValue=$Selflft-$Parentrgt;
    $UpdateSelfSQL="UPDATE `".$this->table."` SET `lft`=`lft`-$TmpValue,`rgt`=`rgt`-$TmpValue WHERE `".$this->cat_id."` IN($InIDS)";
    }
$this->db->createCommand($UpdateLeftSQL)->execute();
$this->db->createCommand($UpdateRightSQL)->execute();
if($this->db->createCommand($UpdateSelfSQL)->execute())
	return true;
else 
	return false;
//$this->referto("成功移动类别","javascript:history.back(1)",3);
//return 1;
} // end func

/**
    * Short description. 
    *
    * Detail description
    * @param         none
    * @global         none
    * @since         1.0
    * @access         private
    * @return         void
    * @update         date time
*/
function checkCategory($CategoryID)
{
//检测父类ID是否存在
$SQL="SELECT * FROM `".$this->table."` WHERE `".$this->cat_id."`='$CategoryID' LIMIT 1";
$Result=$this->db->createCommand($SQL)->queryRow();
if(count($Result)<1){
    $this->referto("父类ID不存在,请检查","javascript:history.back(1)",3);
    }
return $Result;     
} // end func

function display_tree($CategoryID=0){
	$Output=array();
//	$Output='';
    if($CategoryID==0){
    	$CategoryID=$this->getrootid();
    }
  //  return $CategoryID;
    if(empty($CategoryID)){
  //  	return array();
    //	exit;
    }
    $Result = $this->db->createCommand('SELECT lft, rgt FROM `'.$this->table.'` WHERE `'.$this->cat_id.'`='.$CategoryID)->queryRow();
 // 	return 'ok';
    if($Result) {	
    	$Right = array();
    	$Query = 'SELECT * FROM `'.$this->table.'` WHERE lft BETWEEN '.$Result['lft'].' AND '. $Result['rgt'].' ORDER BY lft ASC';
    	$Result = $this->db->createCommand($Query)->queryAll(); 
        foreach($Result as $Row){ 
         	if (count($Right)>0) { 
    				while ($Right[count($Right)-1]<$Row['rgt']) { 
   		 				array_pop($Right);
    				} 
         		}
         //	$Output.=str_repeat('  ',count($Right)) . $Row['cat_name'] . "\n";
    		$Output[]=array('Sort'=>$Row,'Deep'=>count($Right));
     		$Right[] = $Row['rgt'];
     	}
    }
     return $Output;   
}

function get_dynamic_cate($CategoryID=0){
	$origin_arr=$this->display_tree($CategoryID);
	$ret=array();
	foreach ($origin_arr as $row){
		$ret[$row['Sort']['cat_id']]=str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$row['Deep']).'└&nbsp;'.$row['Sort']['cat_name'];
	}
	/*
	foreach($origin_arr as $row){
		$key=$row['Deep'];
		$ret[$key][]=array($row['Sort']['cat_id']=>$row['Sort']['cat_name']);
	}
	*/
	return $ret;
}
/**
    * Short description. 
    *
    * Detail description
    * @param         none
    * @global         none
    * @since         1.0
    * @access         private
    * @return         void
    * @update         date time
*/
function getrootid()
{
$Query="SELECT * FROM`".$this->table."` ORDER BY `lft` ASC LIMIT 1";
$RootID=$this->db->createCommand($Query)->queryRow();
if(count($RootID)>0){
    return $RootID[$this->cat_id];
    }else{
    return 0;
    }
} // end func

/**
    * Short description. 
    *
    * Detail description
    * @param         none
    * @global         none
    * @since         1.0
    * @access         private
    * @return         void
    * @update         date time
*/
function referto($msg,$url,$sec)
{
    echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
    echo "<meta http-equiv=refresh content=$sec;URL=$url>";
         if(is_array($msg)){
    foreach($msg as $key=>$value){
    echo $key."=>".$value."<br>";
             }
             }else{
             echo $msg;
             }
     exit;
} // end func


}
<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/

// no direct access


defined('_JEXEC') or die;

$widthThumb='192px';
$heightThumb='140px';
?>








<style type="text/css">
.fl-as-1 {
	text-align:center;
	margin-bottom:20px;
	min-height:350px;
}
.fl-as-1 h4 {
	line-height:2;
	text-align:center;
}
.fl-as-1 .price {
	color:#75c5cf;
	font-weight:600;
}
</style>

	

    
    
<div class="modproplist-horizontal<?php echo $params->get('moduleclass_sfx'); ?>">
<?php 
for ($i = 0, $n = count($list); $i < $n; $i ++) :
$item = $list[$i]; 
?>




<div class="fl-as-1 col-xs-12 col-sm-6 col-md-6 col-lg-3 bounceIn animated" data-animated="bounceIn" data-start="0">
		<img src="<?php echo $item->image; ?>" class="img-circle" alt="<?php echo str_replace('"',' ',$item->name); ?>" height="125" width="125">
		<h4><?php echo str_replace('"',' ',$item->name); ?></h4>
		<p>
        <?php 
				$saltar=false;
				if($item->name_type & $item->name_category)
					{
					$saltar=true;
					echo $item->name_type.', '.$item->name_category; 
					}elseif($item->name_type)
					{
					$saltar=true;
					echo $item->name_type; 
					}elseif($item->name_category)
					{
					$saltar=true;
					echo $item->name_category; 
					}
					if($saltar){echo '<br>';}
				if($item->address & $item->name_locality)
					{
					echo $item->address.', '.$item->name_locality; 
					}elseif($item->address)
					{
					echo $item->address; 
					}elseif($item->name_locality)
					{
					echo $item->name_locality; 
					}			
				
				?>
                </p>		
		<a href="<?php echo $item->link; ?>" class="btn btn-info" title="Fawlty Towers"><?php echo JText::_('MOD_PROP_LIST_VIEW_DETAILS'); ?></a>
	</div>


<!--
<div class="modproplist-product">
<div class="modproplist-image">
<a href="<?php echo $item->link; ?>" title="<?php echo str_replace('"',' ',$item->name); ?>">
<img class="img" src="<?php echo $item->image; ?>" alt="<?php echo str_replace('"',' ',$item->name); ?>" width="<?php echo $params->get('widthThumb','140'); ?>px" height="<?php echo $params->get('heightThumb','100'); ?>px" />
</a>
</div>

<div class="modproplist-title">
<?php
echo '<'.$params->get('item_heading').'>';
if($params->get('showTitle')){
echo $item->name;
}else{
echo $item->address.'<br> '.$item->name_state.', '.$item->name_locality.'.';
}
echo '</'.$params->get('item_heading').'>';
?>
</div>

<div class="modproplist-detail">
<?php echo $item->name_type.' - '.$item->name_category; ?>
</div>

<div class="modproplist-viewdetail">
<a class="viewdetail" href="<?php echo $item->link; ?>" title="<?php echo str_replace('"',' ',$item->name); ?>">
<?php echo JText::_('MOD_PROP_LIST_VIEW_DETAILS'); ?>
</a>
</div>

<div class="modproplist-separator">
</div>

</div>
-->
<?php endfor; ?>
</div>

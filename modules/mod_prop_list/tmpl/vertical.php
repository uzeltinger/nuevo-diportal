<?php
/**
* @copyright	Copyright(C) 2008-2012 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/

// no direct access


defined('_JEXEC') or die;


?>
<div class="modproplist-vertical<?php echo $params->get('moduleclass_sfx'); ?>">
<?php 
for ($i = 0, $n = count($list); $i < $n; $i ++) :
$item = $list[$i]; 
?>
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
<?php if($params->get('readmore')){?>
<div class="modproplist-viewdetail">
<a class="viewdetail" href="<?php echo $item->link; ?>" title="<?php echo str_replace('"',' ',$item->name); ?>">
<?php echo JText::_('MOD_PROP_LIST_VIEW_DETAILS'); ?>
</a>
</div>
<?php }?>
<div class="modproplist-separator">
</div>

</div>
<?php endfor; ?>
</div>

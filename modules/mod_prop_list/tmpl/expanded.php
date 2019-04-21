<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>
<?php 
jimport('joomla.filesystem.file');
require_once( JPATH_SITE.DS.'components'.DS.'com_properties'.DS.'helpers'.DS.'link.php' );
$ShowWaterMark=null;
$widthThumb=$params->get('widthThumb','140').'px';
$heightThumb=$params->get('heightThumb','100').'px';
$cols=3;
$thisCol = $cols;
$col_padding='0 5px 10px 5px';
$titlelimit=$params->get('titlelimit',26);
?>
<div class="modproplist">
<div class="modproplist_container">
<?php
	for($i=0;$i<count($list);$i++){
	if($thisCol%$cols==0){$thisCol=1;}else{$thisCol++;}	
	//echo $i;
	$item = $list[$i];	
	$item->cat_currency='';
?>
<div class="modproplist_item"> 
<?php
if($item)
	{
	if($item->imagename!=NULL){ $img=$item->image;}else{$img='images/properties/images/noimage.jpg';}	
	$watermark=''; 
	if($ShowWaterMark and $item->available > 0)
		{	
		$watermark='detailsmarket'.$item->available.'-'.$lang->getTag().'.png';
		}		
    ?>    
	<div class="modproplist_itemcolumn" style="width:<?php echo intval(round(100/$cols)); ?>%;"> 
		<div class="column<?php if($thisCol==1){ echo ' first';} if($thisCol==$cols){ echo ' last';}?>">	
			<div class="modproplist_box">
<?php
$sep = (strlen($item->name)>$titlelimit) ? '...' : '';
$item->name=substr($item->name,0,$titlelimit) . $sep;
echo '<h4 class="modproplist_title"><a href="' . $item->link . '">' . $item->name . '</a></h4>';
$src = $img;
$alt = str_replace('"',' ',$item->name);
echo '<div class="watermark_box">';
echo '<a href="' .  $item->link . '"><img class="modproplist_image" src="' . $src . '" alt="' . $alt . '" title="' . $item->name . '" width="' . $widthThumb . '" height="' . $heightThumb . '" /></a>';

				if($watermark)
				{
				if(JFile::exists(JPATH_SITE.DS.'components'.DS.'com_properties'.DS.'includes'.DS.'img'.DS.$watermark)){
				?>
					<img src="<?php echo JURI::base().'components/'.'com_properties/'.'includes/'.'img/'.$watermark; ?>" class="prop_last_watermark" alt="<?php echo JText::_('DETAILS_MARKET'.$item->available); ?>"  />
				<?php 
				} 
				}
				
echo '</div>';
				
				?>
                
                
				<div class="modproplist_fields">
					

<?php
if($item->price!=0){
$priceText = PropertiesHelper::getPriceText($item->price,$item->currency,$item->cat_currency);
}
?>
<div class="modproplist_field">
<span class="label">
<?php echo JText::_('Price'); ?>
</span>
<span class="value">
<?php echo $priceText; ?>
</span>
<div class="clr"></div>
</div>


<div class="modproplist_field">
<span class="value">
<?php echo $item->name_type; ?>
, 
<?php echo $item->name_category; ?>
</span>
<div class="clr"></div>
</div>

<div class="modproplist_field">
<span class="value">
<?php echo $item->address; ?>
</span>
<div class="clr"></div>
</div>


<?php if($item->bedrooms){ ?>
<div class="modproplist_field">
<span class="value">
<?php echo $item->bedrooms.' ';echo $item->bedrooms == 1 ? JText::_('Bedroom') : JText::_('Bedrooms'); ?>
</span>
<div class="clr"></div>
</div>
<?php } ?>



					
				</div>	<!--	modproplist_fields	--> 
			</div><!--	modproplist_box	-->
	</div><!--	column	-->                
</div><!--	modproplist_itemcolumn	-->
<?php	}/*if($item)*/?>
</div><!--	modproplist_item	-->

<?php if($thisCol==$cols){ echo '<div class="clr"></div>';}?>
<?php }  /* for */?>
</div><!--	modproplist_container	-->
</div><!--	modproplist	-->
<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;






$LinkHelper = new LinkHelper();
$propertyItemID=$LinkHelper->getItemid('agentlistings');
$link = '#';

?>




<?php

$ItemID=LinkHelper::getItemid('agentlistings');
//echo $ItemID;
$link = '#';
    $k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)	
    {
$row = &$this->items[$i];
if($ItemID)
{
$link = JRoute::_( 'index.php?option=com_properties&amp;view=agentlistings&amp;aid='.$row->id.':'.$row->alias.'&amp;Itemid='.$ItemID);
}
?>
<div title="<?php echo str_replace('"',' ',$row->name); ?>" class="col-ss-12 col-xs-6 col-sm-6 col-md-4 col-lg-3">
<div class="agent">        
<div class="agentinner">        
<?php
if($row->logo_image!=NULL){ $img=$row->logo_image;}else{$img='noimage.jpg';}
$destino_imagen = JPATH_SITE.'/images/properties/profiles/'.$img;
if (JFile::exists($destino_imagen)){
$imgTag='<img class="agentimage" src="images/properties/profiles/'.$img.'" alt="'. str_replace('"',' ',$row->alias) .'" />'; 
 }else{
 $imgTag='<img src="images/properties/profiles/noimage.jpg" />';}
?>
<div class="details">
<div class="agentimage">
<a href="<?php echo $link; ?>">
<?php echo $imgTag;?>
</a>
</div>

<div class="agent_data">
<a href="<?php echo $link; ?>"><?php echo $row->name; ?></a><br />

<?php if($row->address1){echo  $row->address1.'';} ?><br />
<?php if($row->email){echo  $row->email.'';} ?><br />
<?php if($row->phone){echo JText::_('AGENTS_LIST_PHONE') .' : '. $row->phone.'';} ?><br />
<?php if($row->mobile){echo JText::_('AGENTS_LIST_MOBILE') .' : '. $row->mobile.'';} ?><br />
                 
</div><!--data2 -->


        
</div> <!--details -->
</div><!-- agentinner-->
</div>  <!--agent -->
</div><!-- title-->  
<?php
$k = 1 - $k;
}
 ?>













 

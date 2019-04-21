<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
require_once JPATH_COMPONENT.'/helpers/params.php';

$Product=$this->item;
$Profile=$this->getProfile($Product->agent_id);
$Product->cat_currency=null;
$show_price =  '';
if($this->itemimages)
	{
	$rout_image = 'images/properties/images/'.$Product->id.'/';
	$rout_thumb = 'images/properties/images/thumbs/'.$Product->id.'/';
	$image1 = $this->itemimages[0]->image;
	}else{
	$rout_image = 'images/properties/images/';
	$image1 =$img='no-photo-available.jpg';	
	}	

if($ShowImagesSystemDetail == 1)
	{
		$rel='prettyPhoto[gallery1]';
	}elseif($ShowImagesSystemDetail == 2){
		$rel='dogs0';
	}
/*elseif($ShowImagesSystem == 1){$rel='lightbox['.$Product->id.']';}*/

if($this->print)
	{
	require_once( JPATH_COMPONENT.DS.'views'.DS.'property'.DS.'tmpl'.DS.'print_item.php' );
	}else{	
?>
<div class="property_view">
	<div class="property_view_inner">
<?php
$doc = JFactory::getDocument();
require_once( JPATH_COMPONENT.'/views/templates/detail/'.$this->params->get('DetailLayout','default').'.php' );	
//$doc->addCustomTag('<link rel="stylesheet" href="media/com_properties/css/property_default.min.css" type="text/css" />');
}
?>		
	</div>
</div>
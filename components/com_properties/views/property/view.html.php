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
jimport('joomla.application.component.view');
class PropertiesViewProperty extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $print;

	function display($tpl = null)
	{
	
		$app = JFactory::getApplication();
		$dispatcher = JDispatcher::getInstance();		
		$doc = JFactory::getDocument();
		$lang = JFactory::getLanguage();		$this->langTag = $lang->getTag();		
		$params		= JComponentHelper::getParams('com_properties');
		$this->params = $params;
		$ShowImagesSystemDetail=$params->get('ShowImagesSystemDetail',1);
		$useTranslations=$params->get('useTranslations','0');
		$this->print = JRequest::getBool('print',false);
		$this->state = $this->get('State');
		//$this->stateParams = $this->state->params;
		$this->item = $this->get('Item');
		if($useTranslations)
		{
		require_once( JPATH_COMPONENT.DS.'helpers'.DS.'translation.php' );
		$this->item=translationHelper::getTranslationDetail($this->item,$this->langTag);
		}
		/*
		if(!$item->id)
			{
			$app->redirect(JRoute::_('index.php?option=com_properties&view=properties&Itemid='.LinkHelper::getItemid('properties')));
			}
		*/	
		$this->itemimages = $this->get('ItemImages');
		/*	$this->setLayout($layout);*/	
		$model = $this->getModel();
		$model->hit();	
		$this->_prepareDocumentProperty();
		$doc->addStyleSheet($this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/css/prettyPhoto.css');
		$doc->addStyleSheet($this->baseurl.'/media/com_properties/css/property_default.min.css');
		$doc->addScript($this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js');
		parent::display($tpl);
	}
	

	protected function _prepareDocumentProperty()
	{
		$app	= JFactory::getApplication();
		$lang = JFactory::getLanguage();
		$params		= JComponentHelper::getParams('com_properties');	
		$titleTag = $this->item->name.'. '.$this->item->name_type.' '.$this->item->name_category.' : '.$this->item->ref;

		$this->item->titlePage = $titleTag;
		$this->item->link = $this->getPropertyViewLink($this->item);
		$pathway   = $app->getPathWay();
		$pathway->addItem($this->item->name, $this->item->link);	
		
$rout_image = JURI::root().'images/properties/images/'.$this->item->id.'/'.$this->itemimages[0]->image;
 					
$metadesc = substr(strip_tags($this->item->text),0,300);
$metadesc = str_replace('"',"''",$metadesc);
$metadesc = str_replace("\n"," ",$metadesc);
$metadesc = str_replace("\r"," ",$metadesc);
$metadesc = str_replace("\n\r"," ",$metadesc);

$metakey = $this->item->name;
$metakey .= ', '. $this->item->name_type.' '.$this->item->name_category;
$metakey .= ', '. $this->item->name_type;
$metakey .= ', '. $this->item->name_type.'s';
$metakey .= ', '. $this->item->name_category;
$metakey .= ', '. str_replace(" ", ", ",$this->item->name);

//echo $metakey; require('0');
		
/*	canonicalizacion	*/

$this->document->addCustomTag('<link rel="canonical" href="'.JURI::root().$this->item->link.'" />');

$this->document->addCustomTag('<meta property="og:type" content="website" /> ');
$this->document->addCustomTag('<meta property="og:url" content="'.JURI::root().$this->item->link.'" />');
$this->document->addCustomTag('<meta property="og:title" content="'.$titleTag.'" />');
$this->document->addCustomTag('<meta property="og:image" content="'.$rout_image.'" />');
$this->document->addCustomTag('<meta property="og:description" content="'.$metadesc.'" />');

$this->document->setTitle($titleTag);	

$this->document->setDescription($metadesc);
$this->document->setMetadata('keywords', $metakey);
		if ($this->print)
			{
			$this->document->setMetaData('robots', 'noindex, nofollow');
			}		
		$this->document->setMetadata('generator', $app->getCfg('sitename'));
	}				

	function Images($id,$total)
	{		
	$db 	= JFactory::getDBO();	
	$query = ' SELECT i.* '
			. ' FROM #__properties_images as i '
			. ' WHERE i.published = 1 AND i.parent = '.$id
			. ' order by i.ordering LIMIT '.($total+1);
        $db->setQuery($query);
		$Images = $db->loadObjectList();
	return $Images;
	}
	
	function getProfile($id)
	{		
	$db 	= JFactory::getDBO();	
	$query = ' SELECT pf.* '
			. ' FROM #__properties_profiles as pf '
			. ' WHERE pf.mid = '.$id;
        $db->setQuery($query);
		$Profile = $db->loadObject();
	return $Profile;
	}		
	
	function getPropertyViewLink($row)
		{
		$LinkHelper = new LinkHelper();
		switch($this->params->get('goToPropertyDetails','property'))
			{
			case 'category' :
			$link = $LinkHelper->getLinkPropertyMenu('category', $row);
			break;
			case 'property' :
			$link = $LinkHelper->getProductLink('property', $row);
			break;
			case 'properties' :
			$link = $LinkHelper->getProductLink('properties', $row);
			break;
			default :
			$link = $LinkHelper->getProductLink('property', $row);
			break;
			}
		return $link;
		}	
}

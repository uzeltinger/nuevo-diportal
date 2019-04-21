<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
			
class PropertiesViewProperties extends JViewLegacy
{	
	protected $items;
	protected $pagination;	
	
	

	function display($tpl = null)
	{
	if(	$pid = JFactory::getApplication()->input->get('pid'))
		{
		//require_once JPATH_COMPONENT.'/views/property/displayproperty.php';			
		}
	
	require_once JPATH_COMPONENT.'/helpers/params.php';
    $app = JFactory::getApplication();
	$dispatcher = JDispatcher::getInstance();
	$this->params = JComponentHelper::getParams('com_properties');
	$doc = JFactory::getDocument();
	$task = JRequest::getVar('task');
	$this->state		= $this->get('State');
	$this->items		= $this->get('Items');
	$this->pagination = $this->get('Pagination');
	$this->stateParams = $this->state->params;
	$this->langTag = null;		
	if($this->items)
		{	
		foreach($this->items as $Product)
			{
			$this->Images[$Product->id]	= $this->getImages($Product->id);	
			}
		}
	
	$doc->addStyleSheet('media/com_properties/css/properties.min.css');
	$this->_prepareDocument();
	parent::display();		
	}

	protected function _prepareDocument()
		{
		$doc = JFactory::getDocument();
		$title = '';
		$metadesc = '';
		$metakey = '';
		if($this->stateParams->get('page_title'))
			{
			$title = $this->stateParams->get('page_title', '');
			}	
		
$category_name = '';
if($category = JRequest::getInt('c'))
	{
	$category_name = $this->getMetaDataName($category,'');	
	}
$type_name = '';
if($type = JRequest::getInt('t'))
	{
	$type_name = $this->getMetaDataName('',$type);	
	}

$cadena = '';
if($category_name)
	{
	$cadena = $category_name;	
	}
if($type_name)
	{
	$cadena = $type_name;	
	}	
if($category_name & $type_name)
	{
	$cadena = $type_name . ' ' . $category_name;	
	}	

if($cadena)
{
$title .= $cadena;
$metadesc = $title;
$metakey .= ', '.$cadena;
if($category_name){$metakey .= ', ' . $category_name;}
if($type_name){$metakey .= ', ' . $type_name;}
}

$doc->setTitle($title);	
$doc->setDescription($metadesc);
$doc->setMetadata('keywords', $metakey);		
$this->browserTitle = $title;	
		}	

	

	function getPropertyViewLink($row)
		{
		
		$LinkHelper = new LinkHelper();
		switch($this->stateParams->get('goToPropertyDetails','property'))
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

	public function getImages($parent,$limit=1)
		{
		$db 	= JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('i.*, i.pro_id as parent');
		$query->from('#__properties_images AS i');
		$query->where('i.pro_id = ' . (int) $parent);
		$query->order('i.ordering ASC LIMIT '.$limit);
		$db->setQuery($query);
		$data = $db->loadObjectList();
		return $data;
		}		
		
		public function getMetaDataName($c = null, $t = null)
		{	
		$db 	= JFactory::getDBO();	
		$query = $db->getQuery(true);	
		if($c)
			{
			$query->select('c.name');
			$query->from('#__properties_category AS c');
			$query->where('c.id = '.$c);
			}
		if($t)
			{	
			$query->select('t.name');
			$query->from('#__properties_type AS t');			
			$query->where('t.id = '.$t);
			}			
		$db->setQuery($query);
		$data = $db->loadResult();	
		return $data;	
		} 
}
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

	//$doc->addCustomTag('<link rel="stylesheet" href="media/com_properties/css/properties.min.css" type="text/css" />');

$doc->addStyleSheet('media/com_properties/css/properties.min.css');
//$doc->setMetadata('robots', 'noindex, nofollow');
$this->_prepareDocument();
parent::display();		
}

	protected function _prepareDocument()
		{
		$doc = JFactory::getDocument();
		if($this->stateParams->get('page_title'))
			{
			$title = $this->stateParams->get('page_title', '');
			}	
		$title = $this->stateParams->get('page_title', '');	
		$this->browserTitle = $title;	
		$doc->setTitle($title);			
		if ($this->stateParams->get('menu-meta_description'))
			{
			$doc->setDescription($this->stateParams->get('menu-meta_description'));
			}
		if ($this->stateParams->get('menu-meta_keywords'))
			{
			$doc->setMetadata('keywords', $this->stateParams->get('menu-meta_keywords'));
			}		
		}		

	function getPropertyViewLink($row)
		{
		$LinkHelper = new LinkHelper();
		switch($this->stateParams->get('goToPropertyDetails','property'))
			{
			case 'category' :
			$link = $LinkHelper->getLinkPropertyMenu('category', $row, $this->langTag);
			break;
			case 'property' :
			$link = $LinkHelper->getProductLink('property', $row, $this->langTag);
			break;			
			default :
			$link = $LinkHelper->getProductLink('property', $row, $this->langTag);	
			break;			
			}
		return $link;
		}	

	public function getImages($parent,$limit=1)
		{	
		$db 	= JFactory::getDBO();	
		$query = $db->getQuery(true);		
		$query->select('i.id, i.name, i.parent');
		$query->from('#__properties_images AS i');	
		$query->where('i.parent = ' . (int) $parent);		
		$query->order('i.ordering ASC LIMIT '.$limit);		
		$db->setQuery($query);		
		$data = $db->loadObjectList();		
		return $data;			
		} 
}
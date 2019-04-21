<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modelitem');

class PropertiesModelProperty extends JModelItem
{
	public $_context = 'com_properties.property';
	protected $_extension = 'com_properties';


protected function populateState()
	{
		$app = JFactory::getApplication('site');
		$pk = JRequest::getInt('id');
		$this->setState('property.id', $pk);
		if(JRequest::getVar('ref'))
		{
		$this->setState('property.ref',JRequest::getVar('ref'));
		}		
		if(JRequest::getVar('cid'))
		{
		$this->setState('property.cid',JRequest::getVar('cid'));
		}			
	}
	
	public function &getItem($pk = null)
	{
		$params		= JComponentHelper::getParams('com_properties');
		$useTranslations=$params->get('useTranslations','0');
		$lang = JFactory::getLanguage();
		$thisLang = $lang->getTag();
		
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('property.id');

		if ($this->_item === null) {
			$this->_item = array();
		}
		
		if (!isset($this->_item[$pk])) {

			try {
				$db = $this->getDbo();
				$query = $db->getQuery(true);

		$query->select($this->getState('item.select', 'p.*'));
		$query->from('#__properties_products AS p');
				
		$query->select('c.name as name_category,c.alias as alias_category');
		$query->join('LEFT', '#__properties_category AS c ON c.id = p.cid');		
		$query->select('t.name as name_type,t.alias as alias_type');
		$query->join('LEFT', '#__properties_type AS t ON t.id = p.type');		
		$query->select('cy.name as name_country,cy.alias as alias_country');
		$query->join('LEFT', '#__properties_country AS cy ON cy.id = p.cyid');		
		$query->select('s.name as name_state,s.alias as alias_state');
		$query->join('LEFT', '#__properties_state AS s ON s.id = p.sid');		
		$query->select('l.name as name_locality,l.alias as alias_locality');
		$query->join('LEFT', '#__properties_locality AS l ON l.id = p.lid');
		$query->select('pf.mid as pf_mid,pf.name as pf_name, pf.image as pf_image,pf.canaddproperties,pf.canaddimages');
		$query->join('LEFT', '#__properties_profiles AS pf ON pf.id = p.agent_id');

					
			
			if($pk)
				{				
				$query->where('p.id = ' . (int) $pk);
				}
				
			if ($this->getState('property.ref'))
				{
				$query->where('p.ref = ' . $db->quote($this->getState('property.ref')));	
				}	
				
				
			
				$db->setQuery($query);
				
//echo nl2br(str_replace('#_','jos',$query));require('a');	

				$data = $db->loadObject();
				
				
			$this->_item[$pk] = $data;
			}
			
			catch (JException $e)
			{
				$this->setError($e);
				$this->_item[$pk] = false;
			}
		}	
	//print_r($this->_item[$pk]);							
		return $this->_item[$pk];
	}
			
	
public function hit($pk = 0)
	{
		// Initialise variables.
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('property.id');
		$db = $this->getDbo();

		$db->setQuery(
			'UPDATE #__properties_products' .
			' SET hits = hits + 1' .
			' WHERE id = '.(int) $pk
		);

		if (!$db->query()) {
			$this->setError($db->getErrorMsg());
			return false;
		}		
		return true;
	}
	
	
	public function &getItemImages($pk = null,$limit=null)
	{		
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('property.id');
		$params		= JComponentHelper::getParams('com_properties');
		$canAddProperties=$params->get('canAddProperties',50);
		$canAddImages=$params->get('canAddImages',50);		
		
		if(!$limit)
			{			
			if($this->_item[$pk]->canaddimages)
				{
				$limit=$this->_item[$pk]->canaddimages;
				}else{
				$limit=$canAddImages;
				}
			}	
					
		$db = $this->getDbo();
		$query = $db->getQuery(true);		
		$query->select(
			$this->getState(
				'list.select',
				'i.*' 
			)
		);
		$limit = 50;
		$query->from('#__properties_images AS i');	
		$query->where('i.pro_id = ' . (int) $pk);		
		$query->order($this->getState('list.ordering', 'i.ordering').' '.$this->getState('list.direction', 'ASC').' LIMIT '.$limit);		
		$db->setQuery($query);
		$data = $db->loadObjectList();	
//echo $query;
		return $data;			
	}			
	
}//fin clase
<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.modellist');

class PropertiesModelProperties extends JModelList
{
	public $_context = 'com_properties.properties';
	protected $_extension = 'com_properties';

protected function populateState($ordering = 'ordering', $direction = 'ASC')
	{	
		$app = JFactory::getApplication();
		$params		= JComponentHelper::getParams('com_properties');
		$ShowOrderDefault=$params->get('ShowOrderDefault','asc');
		$ShowOrderByDefault=$params->get('ShowOrderByDefault','ordering');
		if($ShowOrderByDefault=='ordering')
			{
			$ShowOrderByDefault='p.ordering';
			}		
		// List state information
		$value = $app->input->get('limit', $params->get('PropertiesShow',5), 'uint');
		$this->setState('list.limit', $value);
		$value = $app->input->get('limitstart', 0, 'uint');
		$this->setState('list.start', $value);
		$orderCol = $app->input->get('filter_order', $ShowOrderByDefault);		
		if (!in_array($orderCol, $this->filter_fields))
		{
			$orderCol = $ShowOrderByDefault;
		}
		$this->setState('list.ordering', $orderCol);
		$listOrder = $app->input->get('filter_order_Dir', $ShowOrderDefault);
		if (!in_array(strtoupper($listOrder), array('ASC', 'DESC', '')))
		{
			$listOrder = 'ASC';
		}
		$this->setState('list.direction', $listOrder);
		if (trim($ordering) == 'rand()') {
			$this->setState('list.direction', '');			
		}
		$params = $app->getParams();
		$this->setState('params', $params);
		$this->setState('filter.published', 1);		
	}
	
	
	
	
function getListQuery()
	{
		
		$params		= JComponentHelper::getParams('com_properties');				
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$useTranslations=$params->get('useTranslations','0');
	
		$query->select($this->getState('list.select','p.*,p.published AS published' ));		
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
		$query->select('pf.name as profile_name,pf.alias as profile_alias,pf.id as profile_id ,pf.show as profile_show, pf.published as profile_published, pf.logo_image as profile_logo_image');
		$query->join('LEFT', '#__properties_profiles AS pf ON pf.mid = p.agent_id');		
		
		// Filter by language
		if ($this->getState('filter.language')) {
			$query->where('p.language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')');
		}
		
		// Filter by category
		if ($this->getState('category.cid')) {
			$query->where('p.cid = '.$this->getState('category.cid'));
		}
		
		// Filter by locality
		if ($this->getState('locality.lid')) {
			$query->where('p.lid = '.$this->getState('locality.lid'));
		}
		
		/*
		for module search results	
		?cy=1&s=1&l=1&c=2&t=1&bd=1&bt=2&g=2
		*/		
		
		//echo JRequest::getInt('cy');
		if($cy = JRequest::getInt('cy'))
			{
			$query->where('p.cyid = '.$cy);
			}
			
		if($s = JRequest::getInt('s'))
			{
			$query->where('p.sid = '.$s);
			}
			
		if($l = JRequest::getInt('l'))
			{
			$query->where('p.lid = '.$l);
			}
			
		if($c = JRequest::getInt('c'))
			{
			$query->where('p.cid = '.$c);
			}
			
		if($t = JRequest::getInt('t'))
			{
			$query->where('p.type = '.$t);
			}
		
		if($p = JRequest::getInt('p'))
			{
			$query->where('p.capacity = '.$p);
			}
				
		if($bd = JRequest::getInt('bd'))
			{
			$query->where('p.bedrooms = '.$bd);
			}
			
		if($bt = JRequest::getInt('bt'))
			{
			$query->where('p.bathrooms = '.$bt);
			}
			
		if($g = JRequest::getInt('g'))
			{
			$query->where('p.garage = '.$g);
			}
		
		if($cid = JRequest::getInt('cid'))
			{
			$query->where('p.cid = '.$cid);
			}	
		if($type = JRequest::getInt('tid'))
			{
			$query->where('p.type = '.$type);
			}
		
		$agentId = JRequest::getInt('aid');

		if(isset($agentId))
			{
			if($agentId > 0)
				{
						$query->where('pf.id = '.$agentId);
				}	
			}
			
		$query->where('p.published = 1');
		//$query->where('p.available < 2');
		$query->group('p.id');
		$query->order($this->getState('list.ordering', 'p.ordering').' '.$this->getState('list.direction', 'ASC'));
//echo '<br>';
//echo nl2br(str_replace('#_','ou1ds',$query));
		return $query;
	
	}
	
	
	
	public function &getItems()
	{
		$items	= parent::getItems();			
		return $items;	
	}		
  
 	 public function &getItemImages($pk = null,$limit=1)
	{		
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('property.id');
		
		$db = $this->getDbo();
		$query = $db->getQuery(true);		
		$query->select('i.*');
		$query->from('#__properties_images AS i');	
		$query->where('i.pro_id = ' . (int) $pk);		
		$query->order('i.ordering ASC LIMIT '.$limit);		
		$db->setQuery($query);
		$data = $db->loadObjectList();	
//echo $query;
		return $data;			
	}  
}//fin clase
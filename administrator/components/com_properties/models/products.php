<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

class PropertiesModelProducts extends JModelList
{
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields'])) {
			$config['filter_fields'] = array(
				'id', 'a.id',
				'name', 'a.name',
				'c.name', 'c.name',
				't.name', 't.name',
				'l.name', 'l.name',
				's.name', 's.name',
				'cy.name', 'ag.name',
				'alias', 'a.alias',
				'refresh_time', 'a.refresh_time',
				'checked_out', 'a.checked_out',
				'checked_out_time', 'a.checked_out_time',				
				'ordering', 'a.ordering',
				'published', 'a.published',
				'agent', 'ag.name',
			);
			if (JLanguageAssociations::isEnabled())
			{
				$config['filter_fields'][] = 'association';
			}
		}
		parent::__construct($config);
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();
		$jinput = JFactory::getApplication()->input;
		// Adjust the context to support modal layouts.
		if ($layout = $jinput->getString('layout', 'default')) {
			$this->context .= '.'.$layout;
		}
		$search = $app->getUserStateFromRequest($this->context.'.search', 'filter_search');
		$this->setState('filter.search', $search);
		$access = $app->getUserStateFromRequest($this->context.'.filter.access', 'filter_access', 0, 'int');
		$this->setState('filter.access', $access);
		$published = $app->getUserStateFromRequest($this->context.'.published', 'filter_published', '');
		$this->setState('filter.published', $published);	
		// List state information.
		parent::populateState('a.refresh_time', 'desc');		
		// Force a language
		$forcedLanguage = $app->input->get('forcedLanguage');
		if (!empty($forcedLanguage))
		{
			$this->setState('filter.language', $forcedLanguage);
			$this->setState('filter.forcedLanguage', $forcedLanguage);
		}
	}
	
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id.= ':' . $this->getState('filter.search');
		$id.= ':' . $this->getState('filter.access');
		$id.= ':' . $this->getState('filter.published');
		
		return parent::getStoreId($id);
	}
	
	protected function getListQuery($resolveFKs = true)
	{
		// Create a new query object.
		$db = $this->getDbo();
		$query = $db->getQuery(true);		
		$app = JFactory::getApplication();				
		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.*')
		);
		$query->from('#__properties_products AS a');		
		
		$query->select('c.name as category_name');
		$query->join('LEFT', '#__properties_category AS c ON c.id = a.cid');
		
		$query->select('t.name as type_name');
		$query->join('LEFT', '#__properties_type AS t ON t.id = a.type');	
		
		// Join over the locality parent
		$query->select('l.name AS locality_name');
		$query->join('LEFT', '`#__properties_locality` AS l ON l.id = a.lid');
		
		// Join over the state parent
		$query->select('s.name AS state_name');
		$query->join('LEFT', '`#__properties_state` AS s ON s.id = a.sid');
		
		// Join over the Country parent
		$query->select('cy.name AS country_name');
		$query->join('LEFT', '`#__properties_country` AS cy ON cy.id = s.parent');
		
		// Join over the Agent parent
		$query->select('ag.name AS agent_name');
		$query->join('LEFT', '`#__properties_profiles` AS ag ON ag.mid = a.agent_id');
		
		/**/
		// Join over the Image
		//$query->select('i.image AS image_name');
		//$query->join('LEFT', '`#__properties_images` AS i ON i.pro_id = a.id AND i.ordering = 1');
		//$query->where('i.ordering = 1');
		
		// Filter by Agent
		
		$user = JFactory::getUser();
		$canDo	= PropertiesHelper::getActions();
		$allow = $user->authorise('core.admin', 'com_properties');	
		if(!$allow)
			{
			$Profile = $this->getProfile();	
			$query->where('a.agent_id = ' . (int) $Profile->mid);
			}
	
	
		// Filter by published product
		$published = $this->getState('filter.published');
		if (is_numeric($published)) {
			$query->where('a.published = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(a.published = 0 OR a.published = 1)');
		}
		
		// Filter by search in title
		$search = $this->getState('filter.search');
		if (!empty($search)) {
			if (stripos($search, 'id:') === 0) {
				$query->where('a.id = '.(int) substr($search, 3));
			} else  {
				$search = $db->Quote('%'.$db->escape($search, true).'%');
				$query->where('(a.name LIKE '.$search.' OR a.ref LIKE '.$search.')');
			}
		}
		
		if ($language = $this->getState('filter.language'))
		{
			$query->where('a.language = ' . $db->quote($language));
		}
		
		// Add the list ordering clause.
		$orderCol = $this->state->get('list.ordering', 'a.name');
		$orderDirn = $this->state->get('list.direction', 'asc');
		
		//echo '$orderCol'.$orderCol;
		
		$query->order($db->escape($orderCol.' '.$orderDirn));
	
		//echo nl2br(str_replace('#__','jos_',$query));
		
		return $query;
	}	
	
	
	function getAgentProducts() 
  {   
 	$query = 'SELECT * FROM #__properties_products ';		
		$this->_db->setQuery( $query );
			$row = $this->_db->loadObjectList();
		return $row;
  }
  
	function getProducts() 
  {   
 	$query = 'SELECT * FROM #__properties_products ';		
		$this->_db->setQuery( $query );
			$row = $this->_db->loadObjectList();
		return $row;
  }

function getTotalproducts() 
  {   
 	$query = 'SELECT COUNT(id) FROM #__properties_products ';				
		$this->_db->setQuery( $query );
		$this->row = $this->_db->loadResult();	
		return $this->row;
  }
  
function getTotalcategories() 
  {   
 	$query = 'SELECT COUNT(id) FROM #__properties_category ';				
		$this->_db->setQuery( $query );
		$this->row = $this->_db->loadResult();	
		return $this->row;
  }

function getTotaltypes() 
  {   
 	$query = 'SELECT COUNT(id) FROM #__properties_type ';				
		$this->_db->setQuery( $query );
		$this->row = $this->_db->loadResult();	
		return $this->row;
  }
  
  
function getTotalagents() 
  {   
 	$query = 'SELECT COUNT(id) FROM #__users WHERE gid = 21 ';				
		$this->_db->setQuery( $query );
		$this->row = $this->_db->loadResult();
		return $this->row;
  }
  
  
function getTotalpublisher() 
  {   
 	$query = 'SELECT COUNT(id) FROM #__users WHERE gid = 21 ';	
		$this->_db->setQuery( $query );
		$this->row = $this->_db->loadResult();	
		return $this->row;
  }
  
  
function getTotalregistered() 
  {   
 	$query = 'SELECT COUNT(id) FROM #__users WHERE gid = 18 ';				
		$this->_db->setQuery( $query );
		$this->row = $this->_db->loadResult();	
		return $this->row;
  }
  
  
function getMorevisited() 
  {   
 	$query = 'SELECT MAX(p.hits) AS hits, p.* FROM #__properties_products AS p GROUP BY p.id ORDER BY p.hits DESC LIMIT 10';				
		$this->row = $this->_getList($query);

		return $this->row;
  }
  
  public function getProfile()
		{
		$db 	= JFactory::getDBO(); 
		$user = JFactory::getUser();
	
		$query = 'SELECT * FROM #__properties_profiles WHERE mid = '.$user->get('id');		
        $db->setQuery($query);        
		$profile = $db->loadObject();		
		//print_r($profile);
		return $profile;
		}
		
}

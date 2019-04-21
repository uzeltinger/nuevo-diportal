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

class PropertiesModelPanel extends JModelList
{	
	protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();		
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
				
		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.name, a.alias, a.checked_out, a.checked_out_time, a.published, a.ordering,a.agent_id')
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
		/**/
		$query->select('pf.mid AS pf_mid');
		$query->join('LEFT', '#__properties_profiles AS pf ON pf.id = a.agent_id');
	
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
				$query->where('(a.name LIKE '.$search.' OR a.alias LIKE '.$search.')');
			}
		}
		
		// Add the list ordering clause.
		$orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');		
		$query->order($db->escape($orderCol.' '.$orderDirn));

		return $query;
	}	
	
	
	function getProducts() 
	{   
 	$query = 'SELECT p.*,pf.mid as pf_mid,pf.name as agent_name,ug.title AS usergroup_title '.
			' FROM #__properties_products AS p '.
			' LEFT JOIN #__properties_profiles AS pf ON pf.id = p.agent_id'.
			' LEFT JOIN #__user_usergroup_map AS ugm ON ugm.user_id = pf.mid'.
			' LEFT JOIN #__usergroups AS ug ON ug.id = ugm.group_id'
			;	
		//echo str_replace('#_','jos',$query);
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
}
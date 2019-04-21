<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined( '_JEXEC' ) or die( 'Restricted access' );


class PropertiesModelImages extends JModelList
{
function store($data)
	{		
		
		$row = $this->getTable('images');		
		$db		 = JFactory::getDBO();
		
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());			
			return false;
		}
		
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());			
			return false;
		}
		if (!$row->id) {
		$where = "pro_id = " . $db->Quote($row->pro_id);
		$row->ordering = $row->getNextOrder( $where );
		}
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );			
			return false;
		}		
		
		return $row;
	}
	
	
	
	function delimg($img_name)
	{
	$row = $this->getTable('images');
	$db		 = JFactory::getDBO();
		$query = 'SELECT id FROM #__properties_images' .
				' WHERE name = \''.$img_name.'\'';	
	echo $query;						
			$this->_db->setQuery( $query );
			$cid = $this->_db->loadResult();
			
			if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );					
					return false;
				}	
		return true;	
	}
		
}
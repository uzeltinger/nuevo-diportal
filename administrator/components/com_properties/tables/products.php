<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
class PropertiesTableproducts extends JTable
{    
  
	function __construct(&$db)
	{
		parent::__construct( '#__properties_products', 'id', $db );
	}
	function check()
	{		
		if(empty($this->alias)) {
			$this->alias = $this->name;
		}
		
		$datenow = JFactory::getDate();
		if(trim(str_replace('-','',$this->alias)) == '') {
			
			$this->alias = $datenow->toSql();
		}
		if(empty($this->refresh_time))
			{
			$this->refresh_time = $datenow->toSql();		 
			} 
		$this->alias = JFilterOutput::stringURLSafe($this->alias);	
		// Verify that the alias is unique
		
		$table = JTable::getInstance('Products','PropertiesTable');
		
		if ($table->load(array('name'=>$this->name)) && ($table->id != $this->id || $this->id==0)) {
			$this->setError(JText::_('COM_PROPERTIES_ERROR_UNIQUE_NAME'));
			return false;
		}
		
		if ($table->load(array('alias'=>$this->alias)) && ($table->id != $this->id || $this->id==0)) {
			$this->setError(JText::_('COM_PROPERTIES_ERROR_UNIQUE_ALIAS'));
			return false;
		}
		
		
		
		
		if(empty($this->ref)) 
		{
		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$x=0;
		while($x!=1)
			{			
			$getIdent = $this->generateIdent('AAA999');
			$this->ref = $getIdent;
       		 $query = 'SELECT ref FROM #__properties_products WHERE ref=' . $this->_db->Quote( $this->ref ) 
               . ' AND id <>' . intval( $this->id );
        	$this->_db->setQuery( $query );
			$this->row = $this->_db->loadResult();				

        		if ( !$this->row )
				{
				$x=1;
				}
			}
		}
		
		
		return true;
	}
	
	
	function generateIdent($pattern='AAA999')
    {
        $alpha = array("A","B","C","D","E","F","G","H",
             "J","K","L","M","N","P","Q","R","S","T","U","V","W","Y","Z");
        $digit = array("1","2","3","4","5","6","7","8","9");
        // :: TODO :: add check in table for duplicates
        $return = "";
        $pattern_array = str_split($pattern, 1);
        foreach ( $pattern_array as $v ) {
            if ( is_numeric($v) ) {
                $return .= $digit[array_rand($digit)];
            } elseif ( in_array(strtoupper($v), $alpha) ) {
                $return .= $alpha[array_rand($alpha)];
            } else {
                $return .= " ";
            }
        }
        return $return;
    }
	
	
}
?>
<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class PropertiesControllerProduct extends JControllerForm
{
	
	function __construct($config = array())
	{
		parent::__construct($config);			
		
	}	
	
		
	protected function allowAdd($data = array())
	{
	$user = JFactory::getUser();
	$allow = $user->authorise('core.manage.product', 'com_properties');		
	return $allow;
	}
	
	
	
	protected function allowEdit($data = array(), $key = 'id')
	{
	
	$user = JFactory::getUser();
	$recordId	= (int) isset($data[$key]) ? $data[$key] : 0;
	$userId		= $user->get('id');
	
	if($user->authorise('core.admin', 'com_properties'))
		{
		$allow = true;
		}else{
		
		$allow = $user->authorise('core.manage.product', 'com_properties');		

		if($allow)
			{	
			$record		= $this->getModel()->getItem($recordId);	
			$Profile = $this->getModel()->getProfile();		
			$agentId = $record->agent_id;		
			if($Profile->mid != $agentId){$allow = false;}			
			}		
		}		
		
	return $allow;
	}
}
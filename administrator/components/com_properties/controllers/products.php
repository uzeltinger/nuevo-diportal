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

jimport('joomla.application.component.controlleradmin');

class PropertiesControllerProducts extends JControllerAdmin
{
	
	function &getModel($name = 'Product', $prefix = 'PropertiesModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}	
	
	
	
	
	function publish()
	{
	$user = JFactory::getUser();
	
	if($user->authorise('core.admin', 'com_properties'))
		{
		parent::publish();
		}elseif($user->authorise('core.edit.state', 'com_properties')){
		
		$task 	= $this->getTask();
//parent::publish();		
		if($task=='publish')
			{
			$app =& JFactory::getApplication();
			$model	= $this->getModel();	
			$agentProfile = $model->getProfile();
			$agentProductsPublished = $model->getAgentProducts($agentProfile->id,1);
	
				$params		= JComponentHelper::getParams('com_properties');
				$canAddProperties=$params->get('canAddProperties',5);
				$canAddImages=$params->get('canAddImages',5);

				if(!$agentProfile->canaddproperties)
					{
					$agentProfile->canaddproperties=$canAddProperties;
					}
	
				if($agentProfile->canaddproperties <= count($agentProductsPublished))
					{
					$msg = JText::_('Item can not be Published');	
					$this->setRedirect(JRoute::_('index.php?option=com_properties', false), $msg, 'error');				
					}else{
					parent::publish();
					}
			}else{			
		
			parent::publish();
			
			}
			
		}else{
		$msg = JText::_('Item can not be Published');	
					$this->setRedirect(JRoute::_('index.php?option=com_properties', false), $msg, 'error');	
		}
		
		
		
			
	}
	
		
		
}
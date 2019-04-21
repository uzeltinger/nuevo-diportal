<?php
/**
 * @version		$Id: properties.php 1 2010-2014 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;
class PropertiesHelper //extends JHelperContent
{
	public static $extention = 'com_properties';
	
	public static function addSubmenu($vName)
	{		
	$user = JFactory::getUser();
	$userId	= $user->get('id');	
	$manageProduct = $user->authorise('core.manage.product', 'com_properties');	
	$coreAdmin = $user->authorise('core.admin', 'com_properties');

	if($coreAdmin)
		{
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_PANEL'),
			'index.php?option=com_properties&view=panel',
			$vName == 'panel'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_COUNTRIES'),
			'index.php?option=com_properties&view=countries',
			$vName == 'countries'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_STATES'),
			'index.php?option=com_properties&view=states',
			$vName == 'states'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_LOCALITIES'),
			'index.php?option=com_properties&view=localities',
			$vName == 'localities'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_CATEGORIES'),
			'index.php?option=com_properties&view=categories',
			$vName == 'categories'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_TYPES'),
			'index.php?option=com_properties&view=types',
			$vName == 'types'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_PROFILES'),
			'index.php?option=com_properties&view=profiles',
			$vName == 'profiles'
		);		
		}					
		
	if($manageProduct)
		{
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_PRODUCTS'),
			'index.php?option=com_properties&view=products',
			$vName == 'products'
		);
		
		}
	if($manageProduct and !$coreAdmin)
		{	
		JHtmlSidebar::addEntry(
			JText::_('COM_PROPERTIES_MENU_PROFILES'),
			'index.php?option=com_properties&view=profiles',
			$vName == 'profiles'
		);				
		}					
	}
	
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;
		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.delete', 'core.edit', 'core.edit.state', 'core.manage.product'
		);
		foreach ($actions as $action) {
			$result->set($action,	$user->authorise($action, 'com_properties'));
		}
		return $result;
	}	
}
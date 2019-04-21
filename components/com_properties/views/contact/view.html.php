<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
class PropertiesViewContact extends JViewLegacy
{	
	function display($tpl = null)
	{
	$jinput = JFactory::getApplication()->input;
	$layout	= $jinput->get('layout', 'default');
	if($layout == 'modal')
		{
		$jinput->set('tmpl','component');
		}		
	$app = JFactory::getApplication();
	$dispatcher = JDispatcher::getInstance();		
	$this->params = JComponentHelper::getParams('com_properties');
	$doc = JFactory::getDocument();
	$task = $jinput->get('task');
	$this->state		= $this->get('State');
	$doc->addStyleSheet('media/com_properties/css/contactform.css');
	$doc->setMetadata('robots', 'noindex, nofollow');
	parent::display();
	}
}
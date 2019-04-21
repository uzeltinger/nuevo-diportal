<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
require_once JPATH_COMPONENT.'/helpers/link.php';
require_once JPATH_COMPONENT.'/helpers/helper.php';
$params = JComponentHelper::getParams('com_properties');
	if($params->get('loadBootstrapCss',1))
		{
		$doc = JFactory::getDocument();
		//$doc->addStyleSheet('media/com_properties/css/bootstrap.min.css');
		}
$controller = JControllerLegacy::getInstance('Properties');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
?>
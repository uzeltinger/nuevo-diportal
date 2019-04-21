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

/**
 * @package		Joomla.Administrator
 * @subpackage	com_content
 * @since	1.6
 */
class PropertiesControllerStates extends JControllerAdmin
{
	/**
	 * Proxy for getModel
	 * @since	1.6
	 */
	
	function &getModel($name = 'State', $prefix = 'PropertiesModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}
<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('JPATH_BASE') or die;

jimport('joomla.html.html');
jimport('joomla.form.formfield');
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldProductType extends JFormFieldList
{	
	protected $type = 'ProductType';
	
	protected function getOptions()
	{
		$options = array();
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id As value, name As text');
		$query->from('#__properties_type AS a');
		//$query->where('a.parent = ' . (int) $this->form->getValue('cid'));
		$query->where(' ( a.parent = 0 OR a.parent = ' . (int) $this->form->getValue('cid').')');
		$query->order('a.name');
		$db->setQuery($query);
		$options = $db->loadObjectList();
		if ($db->getErrorNum()) {
			JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
		}
		return $options;
	}
}

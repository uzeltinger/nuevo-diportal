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

class JFormFieldProductLocality extends JFormFieldList
{	
	protected $type = 'ProductLocality';
	
	protected function getOptions()
	{
		// Initialize variables.
		$params		= JComponentHelper::getParams('com_properties');
		$UseStateDefault=$params->get('UseStateDefault',0);
		$UseLocalityDefault=$params->get('UseLocalityDefault',0);
		if($this->form->getValue('sid'))
			{
			$LocalityParent = (int) $this->form->getValue('sid');
			}else{
			$LocalityParent = $UseStateDefault;
			}			
		if($this->form->getValue('lid'))
			{			
			}else{
			$this->value = $UseLocalityDefault;
			}					
		$options = array();
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id As value, name As text');
		$query->from('#__properties_locality AS a');
		//$query->where('a.parent = ' . $LocalityParent);
		$query->order('a.name');
		$db->setQuery($query);
		$options = $db->loadObjectList();
		if ($db->getErrorNum()) {
			JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
		}
		return $options;
	}
}

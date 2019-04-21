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

class JFormFieldProductState extends JFormFieldList
{	
	protected $type = 'ProductState';
	
	protected function getOptions()
	{
		$params		= JComponentHelper::getParams('com_properties');
		$UseCountryDefault=$params->get('UseCountryDefault',0);
		$UseStateDefault=$params->get('UseStateDefault',0);		
		if($this->form->getValue('cyid'))
			{
			$StateParent = (int) $this->form->getValue('cyid');
			}else{
			$StateParent = $UseCountryDefault;
			}			
		if($this->form->getValue('sid'))
			{			
			}else{
			$this->value = $UseStateDefault;
			}
		$options = array();
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('id As value, name As text');
		$query->from('#__properties_state AS a');
		//$query->where('a.parent = ' . $StateParent);
		$query->order('a.name');
		$db->setQuery($query);
		$options = $db->loadObjectList();
		if ($db->getErrorNum()) {
			JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
		}
		return $options;
	}
}

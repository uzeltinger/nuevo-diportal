<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;


class PropertiesViewCountry extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	public function display($tpl = null)
	{
		$canDo	= PropertiesHelper::getActions();		
		if (!$canDo->get('core.admin')) {
		$app =& JFactory::getApplication();
		$msg = JText::_('USER ERROR AUTHENTICATION FAILED').' : '. $this->Profile->name;
		$app->Redirect(JRoute::_('index.php?option=com_properties', $msg));	
		}
		
		$this->form		= $this->get('Form');
		$this->item		= $this->get('Item');
		$this->state	= $this->get('State');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JFactory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');
			return false;
		}

		$this->addToolbar();
		
		
		
		parent::display($tpl);
	}

	protected function addToolbar()
	{		
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		
		JToolBarHelper::title($isNew ? JText::_('COM_PROPERTIES_MANAGER_COUNTRY_NEW') : JText::_('COM_PROPERTIES_MANAGER_COUNTRY_EDIT'), 'countries.png');
		
		JToolBarHelper::apply('country.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('country.save', 'JTOOLBAR_SAVE');
			JToolBarHelper::addNew('country.save2new', 'JTOOLBAR_SAVE_AND_NEW');
			
			if (empty($this->item->id))  {
			JToolBarHelper::cancel('country.cancel', 'JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::cancel('country.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}

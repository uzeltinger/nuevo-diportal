<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

class JFormFieldModalProductProfile extends JFormField
{
	public $type = 'ModalProductProfile';
	
	protected function getInput()
	{
		$html = array();
		$link = 'index.php?option=com_properties&amp;view=profiles&layout=modal&amp;tmpl=component&amp;field='.$this->id;
		// Initialize some field attributes.
		$attr = $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
		// Initialize JavaScript field attributes.
		$onchange = (string) $this->element['onchange'];
		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal_'.$this->id);
		// Build the script.
		$script = array();
		$script[] = '	function jSelectUser_'.$this->id.'(id, name) {';
		$script[] = '		var old_id = document.getElementById("'.$this->id.'_id").value;';
		$script[] = '		if (old_id != id) {';
		$script[] = '			document.getElementById("'.$this->id.'_id").value = id;';
		$script[] = '			document.getElementById("'.$this->id.'").value = name;';
		$script[] = '			'.$onchange;
		$script[] = '		}';
		$script[] = '		SqueezeBox.close();';
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

if ($this->value) {
$db			= JFactory::getDBO();
		$query = ' SELECT s.name'
				. ' FROM #__properties_profiles AS s '
				. ' WHERE s.mid = '.$this->value;
$db->setQuery($query);  

		$state_name = $db->loadResult();
}else{
$state_name = '';
}
	//print_r($state_name);require('0');		

		// Create a dummy text field with the user name.
		$html[] = '<div class="fltlft">';
		$html[] = ' <input type="text" id="'.$this->id.'" name="'.$this->id.'"' .
					' value="'.htmlspecialchars($state_name, ENT_COMPAT, 'UTF-8').'"' .
					' disabled="disabled"'.$attr.' />';
		$html[] = '</div>';

		// Create the user select button.
		$html[] = '<div class="button2-left">';
		$html[] = '  <div class="blank">';
		$html[] = '		<a class="modal_'.$this->id.'" title="'.JText::_('COM_PROPERTIES_CHANGE_AGENT').'"' .
							' href="'.($this->element['readonly'] ? '' : $link).'"' .
							' rel="{handler: \'iframe\', size: {x: 800, y: 500}}">';
		$html[] = '			'.JText::_('COM_PROPERTIES_CHANGE_AGENT').'</a>';
		$html[] = '  </div>';
		$html[] = '</div>';

		// Create the real field, hidden, that stored the user id.
		$html[] = '<input type="hidden" id="'.$this->id.'_id" name="'.$this->name.'" value="'.(int) $this->value.'" />';

		return implode("\n", $html);
	}
}
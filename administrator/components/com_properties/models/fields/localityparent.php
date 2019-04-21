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
class JFormFieldLocalityParent extends JFormField
{
	public $type = 'LocalityParent';
	
	protected function getInput()
	{
		$html = array();
		$link = 'index.php?option=com_properties&amp;view=states&layout=modal&amp;tmpl=component&amp;field='.$this->id;

		$attr = $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
		$attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';

		// Initialize JavaScript field attributes.
		$onchange = (string) $this->element['onchange'];

		// Load the modal behavior script.
		JHtml::_('behavior.modal', 'a.modal_'.$this->id);

		// Build the script.
		$script = array();
		
		
		// Select button script
		$script[] = '	function jSelectArticle_' . $this->id . '(id, title, catid, object) {';
		$script[] = '		document.getElementById("' . $this->id . '_id").value = id;';
		$script[] = '		document.getElementById("' . $this->id . '_name").value = title;';
		$script[] = '		jQuery("#modalArticle' . $this->id . '").modal("hide");';
		if ($this->required)
		{
			$script[] = '		document.formvalidator.validate(document.getElementById("' . $this->id . '_id"));';
			$script[] = '		document.formvalidator.validate(document.getElementById("' . $this->id . '_name"));';
		}
		$script[] = '	}';

		// Add the script to the document head.
		JFactory::getDocument()->addScriptDeclaration(implode("\n", $script));

		$params		= JComponentHelper::getParams('com_properties');
		$UseStateDefault=$params->get('UseStateDefault',0);		
		
		if(!$this->value)
			{
			$this->value = $UseStateDefault;
			}
			
		if ((int) $this->value > 0)
		{
		$db    = JFactory::getDbo();
		$query = $db->getQuery(true)
				->select($db->quoteName('name'))
				->from($db->quoteName('#__properties_state'))
				->where($db->quoteName('id') . ' = ' . (int) $this->value);
		$db->setQuery($query);
		
		try
			{
				$state_name = $db->loadResult();
			}
			catch (RuntimeException $e)
			{
				JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');
			} 

		}else{
		$state_name = '';
		}
		
	
		if (0 == (int) $this->value)
		{
			$value = '';
		}
		else
		{
			$value = (int) $this->value;
		}
		$class = '';
		if ($this->required)
		{
			$class = ' class="required modal-value"';
		}
		$url = $link ;
	
		// The current article display field.
		$html[] = '<span class="input-append">';
		$html[] = '<input type="text" class="input-medium" id="' . $this->id . '_name" value="' . $state_name . '" disabled="disabled" size="35" />';
		$html[] = '<a href="#modalArticle' . $this->id . '" class="btn hasTooltip" role="button"  data-toggle="modal" title="'
			. JHtml::tooltipText('COM_PROPERTIES_CHANGE_STATE') . '">'
			. '<span class="icon-file"></span> '
			. JText::_('JSELECT') . '</a>';
		
		
		
		$html[] = '</span>';
		
		$html[] = '<input type="hidden" id="' . $this->id . '_id"' . $class . ' name="' . $this->name . '" value="' . $value . '" />';

		$html[] = JHtml::_(
			'bootstrap.renderModal',
			'modalArticle' . $this->id,
			array(
				'url' => $url,
				'title' => JText::_('COM_PROPERTIES_CHANGE_STATE'),
				'width' => '800px',
				'height' => '300px',
				'footer' => '<button class="btn" data-dismiss="modal" aria-hidden="true">'
					. JText::_("JLIB_HTML_BEHAVIOR_CLOSE") . '</button>'
			)
		);

		return implode("\n", $html);
	}
}
<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class PropertiesViewProduct extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $state;

	public function display($tpl = null)
	{
		
		JHtml::_('behavior.modal', 'a.modal_coord');

		// Initialiase variables.
		$doc = JFactory::getDocument();	
	//	$doc->addStyleSheet('components/com_properties/includes/css/product.css');
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');		
		$this->state	= $this->get('State');
		$this->type_js	= $this->get('type_js');		
		$this->States_js	= $this->get('States_js');
		$this->Localities_js	= $this->get('Localities_js');
		$this->Profile = $this->get('Profile');	
		$params		= JComponentHelper::getParams('com_properties');
		$this->params = $params;
		$canAddProperties=$params->get('canAddProperties',5);
		$canAddImages=$params->get('canAddImages',5);

/**/
if(!isset($this->Profile))
	{
	$this->Profile = new JObject();
if(!isset($this->Profile->canaddproperties))
	{
	$this->Profile->canaddproperties=$canAddProperties;
	}
if(!isset($this->Profile->canaddimages))
	{
	$this->Profile->canaddimages=$canAddImages;
	}	
}
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JFactory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');
			return false;
		}

		$this->addToolbar();		
		
		JHtml::_('jquery.framework');	
		
		if($this->item->id)
			{		
		
		$Images=$this->getImages($this->item->id);
		$this->assignRef('Images',		$Images);
		
$document = JFactory::getDocument();

/*  */ 
 //$document->addScript("http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js");
//$document->addScript("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js");  


$document->addScript("http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js");  

/*
$document->addScript("components/com_properties/includes/js/vendor/jquery.ui.widget.js");
$document->addScript("components/com_properties/includes/js/jquery.iframe-transport.js");
$document->addScript("components/com_properties/includes/js/jquery.fileupload.js");
*/

$session = JFactory::getSession();

//$myItemObject->id=62;
/*
thumbnail_url: "'.JURI::root().'images/properties/images/",
flash_url : "'.JURI::base().'components/com_properties/includes/SWFUpload/swfupload/swfupload.swf",
"idproduct" : "'.$this->item->id.'",	
"option" : "com_properties",
				"view" : "images",                
				"format" : "raw",
                "task" : "images.swfupload_files",		
*/				
				

/*	
$document->addScriptDeclaration("
	jQuery(function () {
    
    // Change this to the location of your server-side upload handler:
    var url = 'index.php?option=com_properties&task=images.save_images&format=raw&id=1'; 
	//JURI::root().'images/properties/images/\';
    jQuery('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            jQuery.each(data.result.files, function (index, file) {
                jQuery('<p/>').text(file.name).appendTo('#files');
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            jQuery('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !jQuery.support.fileInput)
        .parent().addClass(jQuery.support.fileInput ? undefined : 'disabled');
});   
");
*/

if($this->params->get('categoryToShowCalendar','-1') == $this->item->cid)
						{

/*
$doc->addScriptDeclaration('
window.addEvent(\'domready\', function() {   
elementoFormulario = $("calendar-form");    
   elementoFormulario.addEvent(\'submit\', function(e) {	  
      e.stop();	  
	  $("progressCalendar").setStyle("visibility","visible");	  
      this.set(\'send\', {		 
         onComplete: function(respuesta) {		 			
            $("resultCalendar").set(\'html\', respuesta);	
			$("progressCalendar").setStyle("visibility","hidden");		
         }
      });
      this.send();
   });
});
');

$doc->addScriptDeclaration('
window.addEvent(\'domready\', function() {   
elementoFormulario = $("rates-form");    
   elementoFormulario.addEvent(\'submit\', function(e) {	  
      e.stop();	  
	  $("progressRRL").setStyle("visibility","visible");	  
      this.set(\'send\', {		 
         onComplete: function(respuesta) {		 			
            $("RefreshRatesList").set(\'html\', respuesta);	
			$("progressRRL").setStyle("visibility","hidden");		
         }
      });
      this.send();
   });
});
');


$doc->addScriptDeclaration('
window.addEvent(\'domready\', function() {   
	$$(\'.publishstopme\').each(function(el) {
    	el.addEvent(\'click\', function(e) {
      	e = new Event(e).stop();
		});
	});
});
');
*/
			}



	}
	
	
	
	
	$canDo	= PropertiesHelper::getActions();
	if ($canDo->get('core.manage')) {
		$this->iAmAdmin=true;
		}else{
		$this->iAmAdmin=false;
		$this->checkAgent();
		}
			
		parent::display($tpl);
	}
	
	protected function checkAgent()
	{
	if($this->item->id and $this->Profile->id != $this->item->agent_id)
		{
				
		JFactory::getApplication()->enqueueMessage(JText::_('USER ERROR AUTHENTICATION FAILED : '. $this->Profile->name), 'error');
		}
	}
	
	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$isNew		= ($this->item->id == 0);
		$canDo	= PropertiesHelper::getActions();
		$checkedOut	= !($this->item->checked_out == 0 || $this->item->checked_out == $user->get('id'));
		
		JToolBarHelper::title($isNew ? JText::_('COM_PROPERTIES_MANAGER_PRODUCT_NEW') : JText::_('COM_PROPERTIES_MANAGER_PRODUCT_EDIT').' : '.$this->item->name, 'products.png');
		
		JToolBarHelper::apply('product.apply', 'JTOOLBAR_APPLY');
			JToolBarHelper::save('product.save', 'JTOOLBAR_SAVE');
			
			JToolBarHelper::addNew('product.save2new', 'JTOOLBAR_SAVE_AND_NEW');
			
			if (empty($this->item->id))  {
			JToolBarHelper::cancel('product.cancel', 'JTOOLBAR_CANCEL');
		} else {
			JToolBarHelper::cancel('product.cancel', 'JTOOLBAR_CLOSE');
		}
	}
	
	
	
	
	function getImages($id,$total=1)
	{	
	$db 	= JFactory::getDBO();	
	$query = ' SELECT i.* '			
			. ' FROM #__properties_images as i '					
			. ' WHERE i.published = 1 AND i.parent = '.$id			
			. ' order by i.ordering ';		
        $db->setQuery($query);
		$Images = $db->loadObjectList();
	return $Images;
	}
	
	
	
}

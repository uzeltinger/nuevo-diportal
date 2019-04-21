<?php
/**
* @copyright	Copyright(C) 2008-2012 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;

$doc = JFactory::getDocument();	
//$doc->addCustomTag('<link rel="stylesheet" href="media/mod_prop_list/css/mod_prop_list_'.$params->get('layout', 'vertical').'.css" type="text/css" />');
//JHTML::_('behavior.modal','a.contactmodal');
require_once dirname(__FILE__).'/helper.php';

$cParams = JComponentHelper::getParams('com_properties');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$list = modPropListHelper::getList($params,$cParams);
require JModuleHelper::getLayoutPath('mod_prop_list', $params->get('layout', 'vertical'));
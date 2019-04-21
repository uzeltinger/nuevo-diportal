<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;
$doc = JFactory::getDocument();	
$doc->addCustomTag('<link rel="stylesheet" href="modules/mod_prop_search/css/mod_prop_search.css" type="text/css" />');

require_once dirname(__FILE__).'/helper.php';
$cParams = JComponentHelper::getParams('com_properties');
$ComboCategories = modPropertiesSearchHelper::getComboCategories($params,$cParams);
$comboBeds = modPropertiesSearchHelper::getComboBeds($params,$cParams);
$comboBaths = modPropertiesSearchHelper::getComboBaths($params,$cParams);
//$comboCapacity = modPropertiesSearchHelper::getComboCapacity($params,$cParams);
$ComboTypes = modPropertiesSearchHelper::getComboTypes($params,$cParams);
$comboStates = modPropertiesSearchHelper::getComboStates($params,$cParams);
$listLocalities = modPropertiesSearchHelper::getListLocalities($params,$cParams);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));
require JModuleHelper::getLayoutPath('mod_prop_search', $params->get('layout', 'vertical'));
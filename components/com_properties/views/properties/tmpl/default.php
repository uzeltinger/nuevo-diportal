<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');	
$params		= JComponentHelper::getParams('com_properties');
require_once( JPATH_COMPONENT.'/helpers/params.php' );
?>
<div id="properties_list">
<div class="properties_list_inner">
<?php
require_once( JPATH_COMPONENT.'/views/templates/list/'.$this->params->get('Listlayout','default').'.php' );	
?>
</div>
</div>
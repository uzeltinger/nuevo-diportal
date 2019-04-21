<?php
/**
 * @version		$Id: edit_options.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Administrator
 * @subpackage	com_categories
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die; ?>

<?php echo JHtml::_('sliders.panel',JText::_('JGLOBAL_FIELDSET'), 'publishing-details'); ?>

	<fieldset class="panelform">
		<ul class="adminformlist">

    <li><?php echo $this->form->getLabel('layout'); ?>
	<?php echo $this->form->getInput('layout'); ?></li>
    
	<li><?php echo $this->form->getLabel('metadesc'); ?>
	<?php echo $this->form->getInput('metadesc'); ?></li>

	<li><?php echo $this->form->getLabel('metakey'); ?>
	<?php echo $this->form->getInput('metakey'); ?></li>
    
		</ul>
	</fieldset>


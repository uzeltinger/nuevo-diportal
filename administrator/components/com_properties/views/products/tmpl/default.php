<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$app		= JFactory::getApplication();
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$archived	= $this->state->get('filter.published') == 2 ? true : false;
$trashed	= $this->state->get('filter.published') == -2 ? true : false;
$saveOrder	= $listOrder == 'a.ordering';

if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_properties&task=products.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}

$sortFields = $this->getSortFields();
$assoc		= JLanguageAssociations::isEnabled();


$params		= JComponentHelper::getParams('com_properties');
	$expireDays=$params->get('expireDays',365);
?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_properties&view=products'); ?>" method="post" name="adminForm" id="adminForm">
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>	
    
		<?php
		echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this));
		?>
        <table class="table table-striped" id="articleList">
			<thead>
				<tr>
					<th class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>
					</th>
					<th class="hidden-phone">
							<?php echo JHtml::_('grid.checkall'); ?>
					</th>
                    <th style="min-width:55px" class="nowrap center hidden-phone">
                        
                    </th>
					<th style="min-width:55px" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'Codigo', 'a.ref', $listDirn, $listOrder); ?>
					</th>
                    <th style="min-width:55px" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'COM_PROPERTIES_TITLE_VIEWS', 'a.hits', $listDirn, $listOrder); ?>
					</th>                     
                    <th style="min-width:55px" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'COM_PROPERTIES_TITLE_CATEGORY_NAME', 'c.name', $listDirn, $listOrder); ?>
                    </th>
                    <th style="min-width:55px" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'COM_PROPERTIES_TITLE_TYPE_NAME', 't.name', $listDirn, $listOrder); ?>
                    </th>
                    <th style="min-width:55px" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'COM_PROPERTIES_TITLE_LOCALITY_NAME', 'l.name', $listDirn, $listOrder); ?>
                    </th>
                    <th style="min-width:55px" class="nowrap center">
							<?php echo JHtml::_('searchtools.sort', 'COM_PROPERTIES_TITLE_AGENT_NAME', 'ag.name', $listDirn, $listOrder); ?>
                    </th> 
                    <th style="min-width:55px" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'COM_PROPERTIES_TITLE_REFRESHTIME', 'a.refresh_time', $listDirn, $listOrder); ?>
                    </th>                       
                    <th style="min-width:55px" class="nowrap center hidden-phone">
							<?php echo JHtml::_('searchtools.sort', 'COM_PROPERTIES_TITLE_PUBLISHED', 'a.published', $listDirn, $listOrder); ?>
                    </th>
                    <th class="nowrap">
							<?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                    </th>
                </tr>                
            </thead>
	<tbody>             
                                
            <?php 			
foreach($this->items as $i => $item): 
$ordering	= ($listOrder == 'ordering');
$row = &$this->items[$i];
$link 		= JRoute::_( 'index.php?option=com_properties&task=product.edit&id='.(int) $item->id);	
		?>
        <tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $row->parent != 0 ? $row->parent:999; ?>">
			<td class="order nowrap center hidden-phone">  
            
            <?php
							$canChange  = 1;
							$iconClass = '';
							if (!$canChange)
							{
								$iconClass = ' inactive';
							}
							elseif (!$saveOrder)
							{
								$iconClass = ' inactive tip-top hasTooltip" title="' . JHtml::tooltipText('JORDERINGDISABLED');
							}
							?>
                            
               	<span class="sortable-handler<?php echo $iconClass ?>">
					<i class="icon-menu"></i>
				</span>
            <?php if ($canChange && $saveOrder) : ?>
								<input type="text" style="display:none" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order " />
			<?php endif; ?>                 
			</td>            
			<td width="5" class="hidden-phone">
				<?php echo JHtml::_('grid.id', $i, $item->id); ?>	
			</td>            
            <td width="5" class="hidden-phone">				
            <?php  
			if(isset($this->Images[$item->id]))
			{
			$img_path = JURI::root().'images/properties/images/thumbs/'.$row->id.'/'.$this->Images[$item->id]->image;
			?>			
            <img width="60" src="<?php echo $img_path;?>" />			
            <?php } ?>            	
			</td>            
			<td>
				<span class="editlinktip hasTooltip" title="<?php echo $row->name; ?>">
				<a href="<?php echo $link  ?>">
					<?php echo $row->ref; ?></a></span>
			</td>            
			<td align="center">
				<?php echo $row->hits; ?>
			</td>            
            <td align="center" class="hidden-phone">
				<?php echo $row->category_name; ?>
			</td>
            <td align="center" class="hidden-phone">
				<?php echo $row->type_name; ?>
			</td>
            <td align="center" class="hidden-phone">
				<?php echo $row->locality_name; ?>
			</td>
            <td align="center">
				<?php echo $row->agent_name; ?>
			</td>
            <td align="center" class="hidden-phone">
				<?php //echo $row->refresh_time; ?>                
                <?php echo JHtml::_('date', $row->refresh_time, 'Y-m-d H:i:s'); ?>                
			</td>
            <td align="center" class="hidden-phone">
				<?php echo JHtml::_('jgrid.published', $item->published, $i, 'products.', 1);?>
			</td>            
            <td align="center">
				<?php echo $row->id; ?>
			</td>
        </tr>
<?php endforeach; ?>                
                </tbody>
        </table>        
        <?php echo $this->pagination->getListFooter(); ?>
		<?php //Load the batch processing form. ?>
		<?php echo $this->loadTemplate('batch'); ?>        
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>        
    </div>
</form>
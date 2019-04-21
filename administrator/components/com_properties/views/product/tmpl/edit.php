<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// Create shortcut to parameters.
$params = $this->state->get('params');

$app = JFactory::getApplication();
$input = $app->input;

// This checks if the config options have ever been saved. If they haven't they will fall back to the original settings.
$params = json_decode($params);

?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'product.cancel' || document.formvalidator.isValid(document.id('product-form')))
		{
			<?php //echo $this->form->getField('articletext')->save(); ?>
			Joomla.submitform(task, document.getElementById('product-form'));
		}
	}
	
	
	
	function jSelectCoord(lat,lng) {
			document.getElementById('jform_lat').value = lat;
			document.getElementById('jform_lng').value = lng;	
		SqueezeBox.close();
	}
	
</script>






<form action="<?php JRoute::_('index.php?option=com_properties&layout=edit&id='); ?>" method="post" name="adminForm" id="product-form" class="form-validate">


<div class="form-horizontal">    


    
    <?php //echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>


<?php echo JHtml::_('bootstrap.startTabSet', 'myPropTab', array('active' => 'data')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myPropTab', 'data', JText::_('COM_PROPERTIES_DATA', true)); ?>
        
        
    <div class="row-fluid form-horizontal-desktop">
		<div class="span6">  
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('parent'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('parent'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('ref'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('ref'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('cid'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('cid'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('type'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('type'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('cyid'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('cyid'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('sid'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('sid'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('lid'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('lid'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('address'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('address'); ?>
				</div>
			</div>
                     
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('name'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('name'); ?>
				</div>
			</div>
                
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('alias'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('alias'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('agent_id'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('agent_id'); ?>
				</div>
			</div>
                
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('published'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('published'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('featured'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('featured'); ?>
				</div>
			</div>            
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('available'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('available'); ?>
				</div>
			</div>
                
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('id'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('id'); ?>
				</div>
			</div>
            
            
            
             <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('refresh_time'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('refresh_time'); ?>
				</div>
			</div>
                
					
		</div>
		<div class="span6">
			<div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('capacity'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('capacity'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('rooms'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('rooms'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('bedrooms'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('bedrooms'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('bathrooms'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('bathrooms'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('garage'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('garage'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('area'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('area'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('covered_area'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('covered_area'); ?>
				</div>
			</div>
            
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('years'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('years'); ?>
				</div>
			</div>
            
            <div class="control-group">
				<div class="control-label">
					<?php echo $this->getForm()->getLabel('price'); ?>
				</div>
				<div class="controls">
					<?php echo $this->getForm()->getInput('price'); ?>
				</div>
			</div>           
           
		</div>
	</div>
    
    
    
    <?php echo JHtml::_('bootstrap.endTab'); ?>
    
    


    
    <?php echo JHtml::_('bootstrap.addTab', 'myPropTab', 'description', JText::_('COM_PROPERTIES_DESCRIPTION', true)); ?>    
    <?php echo $this->getForm()->getInput('text'); ?>
    <?php echo JHtml::_('bootstrap.endTab'); ?>
    
    
    
    
    
    
    
    
    
    
    
    
    
    <?php echo JHtml::_('bootstrap.addTab', 'myPropTab', 'map', JText::_('COM_PROPERTIES_MAP', true)); ?>    
    
	<div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('lat'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('lat'); ?>
						</div>
					</div>
                    
                    <div class="control-group">
						<div class="control-label">
							<?php echo $this->form->getLabel('lng'); ?>
						</div>
						<div class="controls">
							<?php echo $this->form->getInput('lng'); ?>
						</div>
					</div>                  
                    				
				<label id="jform_getcoord-lbl" for="jform_getcoord" class="hasTip" title="">														
                   <strong>                   
                   <a class="modal-button modal modal_coord" title="<?php echo JText::_( 'COM_PROPERTIES_FIELD_GETCOORD_LABEL' ); ?>" href="index.php?option=com_properties&view=properties&task=map.mapgetcoord&id=<?php echo $this->item->id;?>&tmpl=ajax" rel="{handler: 'iframe', size: {x: 750, y: 475}}"><?php echo JText::_( 'COM_PROPERTIES_FIELD_GETCOORD_LABEL' ); ?></a>
                    </strong>	
                    </label>    
                    
				
					
                  



    <?php echo JHtml::_('bootstrap.endTab'); ?>
    
    

	<input type="hidden" name="myOrden" id="myOrden" value="" />
	<input type="hidden" name="task" value="" />
    <input type="hidden" name="return" value="<?php echo $input->getCmd('return'); ?>" />
	<?php echo JHtml::_('form.token'); ?>
 
    
    
    <?php echo JHtml::_('bootstrap.addTab', 'myPropTab', 'images', JText::_('COM_PROPERTIES_IMAGES', true)); ?>       
    
    
    
    
    
    
    <?php require_once(JPATH_COMPONENT.'/views/product/tmpl/edit_images.php');?>


</form>   







<form action="<?php JRoute::_('index.php?option=com_properties&layout=edit&id='); ?>" method="post" name="adminForm" enctype="multipart/form-data" >

	<span class="btn btn-success fileinput-button">
        <i class="glyphicon glyphicon-plus"></i>
        <span>Select files...</span>
		<input type="file" id="multifiles" name="Filedata[]" multiple />   
    </span>
    <br><br>
     
    <button class="btn btn-success" type="submit" value="enviar">enviar</button>
    
    
	<input type="hidden" name="option" value="com_properties" />
	<input type="hidden" name="task" value="images.save_images_files" />
    <input type="hidden" name="format" value="raw" />    
    <input type="hidden" name="idproduct" value="<?php echo $this->item->id; ?>" />
	<?php echo JHtml::_('form.token'); ?>
<div class="clr"></div>




	
    <?php echo JHtml::_('bootstrap.endTab'); ?>
    
    
    
    <?php echo JHtml::_('bootstrap.endTabSet'); ?>
</div>

</form>
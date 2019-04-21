<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;
?>    
<div class="modproplist-horizontal<?php echo $params->get('moduleclass_sfx'); ?>">
<?php 
$x=0;
for ($i = 0, $n = count($list); $i < $n; $i ++) :
$item = $list[$i];
$pares=false;$trios=false;$cuartetos=false;
$paresClass = '';
if($x>0)
	{
if($x%2==0){$pares=true;}
if($x%3==0){$trios=true;}
if($x%4==0){$cuartetos=true;}
if($pares){$paresClass = ' paresclass';}else{$paresClass = '';}
if($trios){$paresClass.= ' triosclass';}
if($cuartetos){$paresClass.= ' cuartetosclass';}
	}
$x++;	
?>
<div title="<?php echo str_replace('"',' ',$item->name); ?>" class="col-ss-12 col-xs-6 col-sm-6 col-md-3 col-lg-3<?php echo $paresClass;?>">
	<div class="panel panel-default pan-property">		
        <div class="thumbnails thumbnail-style thumbnail-kenburn">
        	<div class="thumbnail-img">
        		<div class="overflow-hidden">        
					<img src="<?php echo $item->image; ?>" alt="<?php echo str_replace('"',' ',$item->name); ?>" title="<?php echo str_replace('"',' ',$item->name); ?>" class="img-responsive">
          		</div>
          	</div>
          </div>            
		<div class="panel-body">
			<h4>
				<a href="<?php echo $item->link; ?>" title="<?php echo str_replace('"',' ',$item->name); ?>" property_name="<?php echo str_replace('"',' ',$item->name); ?>"><?php echo $item->name_type.', '.$item->name_category;?></a>
			</h4>
		</div>
		<div class="list-group">
			<span class="list-group-item"><?php echo $item->address; ?>&nbsp;</span> 
			<span class="list-group-item">Monte Hermoso <span class="pull-right">Bs As</span></span>
			<span class="list-group-item">Capacidad: <span class="pull-right"><?php echo $item->capacity.' ';echo $item->capacity == 1 ? JText::_('Persona') : JText::_('Personas'); ?></span></span>
			<span class="list-group-item">Cuartos: <span class="pull-right"><?php echo $item->bedrooms.' ';echo $item->bedrooms == 1 ? JText::_('Dormitorio') : JText::_('Dormitorios'); ?></span></span>
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-0 col-sm-4 col-md-4 col-lg-6">
					<p><strong></strong></p>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
					<p><a class="btn btn-md btn-success btn-block" href="<?php echo $item->link; ?>" title=""><?php echo JText::_('MOD_PROP_LIST_VIEW_DETAILS'); ?></a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endfor; ?>
</div>
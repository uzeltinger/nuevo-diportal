<?php
/**
* @copyright	Copyright(C) 2008-2010 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;



$doc = JFactory::getDocument();






$js = <<<JS
jQuery.noConflict();
jQuery(document).ready(function(event) {


	
  

	jQuery('#myContactModal').on('hidden.bs.modal', function () {
		var modalBodyB = jQuery('#myContactModal').find('.modal-body');
        modalBodyB.find('iframe').remove();
		modalBodyB.find('.modal-title').text('');
    })
	
   jQuery('#myContactModal').on('shown.bs.modal', function(e) {
   
   var button = jQuery(e.relatedTarget); // Button that triggered the modal
	var id = button.data('id'); // Extract info from data-* attributes
	var name = button.data('name');
	//alert(ref);
	var modal = jQuery('#myContactModal');
	modal.find('.modal-title').text(name);
 	
	//modal.find('.modal-body input').val(recipient);  
   
   
       jQuery('body').addClass('modal-open');
       var modalBodyB = jQuery('#myContactModal').find('.modal-body');
       modalBodyB.find('iframe').remove();
       modalBodyB.prepend('<iframe scrolling="no" frameborder="0" class="iframe" src="index.php?option=com_properties&view=contact&id=' + id + '&layout=modal" name="Tipo de elemento del menú" height="520px" width="100%"></iframe>');	 
   }).on('hide', function () {
       jQuery('body').removeClass('modal-open');
   });
});
JS;

$doc->addScriptDeclaration($js);






$js = <<<JS
(function ($) {
	var processing = false;
	var calls = 1;
		$(window).scroll(function(){
		
		
		    if($(window).scrollTop() == $(document).height() - $(window).height()){
		    	$('div#loadmoreajaxloader').show();
				//$("#postswrapper").append($(document).height());
				if (processing)	{return false;}		
				request = {
					'option' : 'com_ajax',
					'module' : 'prop_list',					
					'format' : 'html',
					'calls' : calls
				};
				
				$.ajax({
					type   : 'POST',
					data   : request,
					//url: "index.php?option=com_ajax&module=infinitescroll_articles_category&format=json",
					success: function(html){
						if(html){
							$("#postswrapper").append(html);
							$('div#loadmoreajaxloader').hide();
							calls++;
						}else{							
							$('div#loadmoreajaxloader').hide();
							$('div#loadmoreajaxnomore').show();
							//$('div#offers').show();
							//$('div#nature').show();
							
						}
						//processing = true;
					}					
				});
				processing = false;
		    }
		});
})(jQuery);
JS;

$doc->addScriptDeclaration($js);



?>  


<style>
		

.modproplist-horizontal_topfeatured #newpostlink{
			display:block;text-align:center;border:2px solid #414141;background:#7D7D7D;color:#fff; margin: 0 0 10px;padding:5px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px;font-size:20px;text-decoration:none;
		}
		
	</style>
    
 
 
<div class="contentwraper">
    
      
<div id="postswrapper" class="modproplist-horizontal<?php echo $params->get('moduleclass_sfx'); ?>">
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
        <a href="<?php echo $item->link; ?>" title="<?php echo str_replace('"',' ',$item->name); ?>">
        	<div class="thumbnail-img">
        		<div class="overflow-hidden">
                	<div class="imagenfondo" style="background-image: url('<?php echo $item->image; ?>');">&nbsp;</div>
					<!--<img src="<?php echo $item->image; ?>" alt="<?php echo str_replace('"',' ',$item->name); ?>" title="<?php echo str_replace('"',' ',$item->name); ?>" class="img-responsive">-->
          		</div>
          	</div>
            </a>
          </div>
                    
		<div class="panel-body">
			<h4>
            	<a class="titlelink" href="<?php echo $item->link; ?>" title="<?php echo str_replace('"',' ',$item->name); ?>"><?php echo str_replace('"',' ',$item->name);?></a>
            <!--
				<a href="<?php echo $item->link; ?>" title="<?php echo str_replace('"',' ',$item->name); ?>"><?php echo $item->name_type.' en '.$item->name_category;?></a>
                -->
			</h4>
		</div>
		<div class="list-group">
        	<span class="list-group-item type_category">
			<h3><?php echo $item->name_type.' '.$item->name_category;?></h3>	
            </span>
			<span class="list-group-item overflow-hiden">Monte Hermoso&nbsp;<?php echo $item->address; ?></span> 
			
			<span class="list-group-item"><?php echo $item->capacity.' ';echo $item->capacity == 1 ? JText::_('Persona') : JText::_('Personas'); ?><span class="pull-right"><?php echo $item->bedrooms.' ';echo $item->bedrooms == 1 ? JText::_('Dormitorio') : JText::_('Dormitorios'); ?></span></span>
			
		</div>
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<p>
                    <button type="button" class="btn btn-info btn-md btn-block btn-contactar" data-toggle="modal" data-target="#myContactModal" data-id="<?php echo str_replace('"',' ',$item->id); ?>" data-name="<?php echo str_replace('"',' ',$item->name); ?>">Contactar</button>                    
                    </p>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<p><a class="btn btn-md btn-success btn-block" href="<?php echo $item->link; ?>" title=""><?php echo JText::_('Detalles'); ?></a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endfor; ?>










<div id="myContactModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">

<!--
<iframe scrolling="no" frameborder="0" class="iframe" src="index.php?option=com_properties&view=contact&id=1&layout=modal" name="Tipo de elemento del menú" height="430px" width="100%"></iframe>
-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>










































<?php 
/*
$x=0;
$devolver = '';
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
$devolver .= '
<div title="'.str_replace('"',' ',$item->name).'" class="col-ss-12 col-xs-6 col-sm-6 col-md-3 col-lg-3'.$paresClass.'">
';
$devolver .= '<div class="panel panel-default pan-property">';
$devolver .= '<div class="thumbnails thumbnail-style thumbnail-kenburn">';
$devolver .= '<a href="'.$item->link.'" title="'.str_replace('"',' ',$item->name).'">';
$devolver .= '<div class="thumbnail-img">';
$devolver .= '<div class="overflow-hidden">';
$devolver .= '<div class="imagenfondo" style="background-image: url(\''.$item->image.'\');">&nbsp;</div>';
$devolver .= '</div>';
$devolver .= '</div>';
$devolver .= '</a>';
$devolver .= '</div>';
$devolver .= '<div class="panel-body">';
$devolver .= '<h4>';
$devolver .= '<a href="'.$item->link.'" title="'.str_replace('"',' ',$item->name).'">'.$item->name_type.', '.$item->name_category.'</a>';
$devolver .= '</h4>';
$devolver .= '</div>';
$devolver .= '		<div class="list-group">';
$devolver .= '			<span class="list-group-item">'.$item->address.'&nbsp;</span>';
$devolver .= '			<span class="list-group-item">Monte Hermoso <span class="pull-right">Bs As</span></span>';
$devolver .= '			<span class="list-group-item">Capacidad: <span class="pull-right">'.$item->capacity.' '.$item->capacity == 1 ? JText::_('Persona') : JText::_('Personas').'</span></span>';
$devolver .= '			<span class="list-group-item">Cuartos: <span class="pull-right">'.$item->bedrooms.' '.$item->bedrooms == 1 ? JText::_('Dormitorio') : JText::_('Dormitorios').'</span></span>';
$devolver .= '		</div>';
$devolver .= '
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-0 col-sm-4 col-md-4 col-lg-6">
					<p><strong></strong></p>
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
					<p><a class="btn btn-md btn-success btn-block" href="<?php echo $item->link; ?>" title="">'. JText::_('MOD_PROP_LIST_VIEW_DETAILS').'</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
';
endfor; 
echo $devolver;
*/
?>

































</div>


<div style="width:100%; height:100px; float:left">
<div id="loadmoreajaxloader" style="display: none; background:url(media/com_properties/img/ajax-loader.gif) center center no-repeat;"> &nbsp; </div>

<div id="loadmoreajaxnomore" style="display: none;"><center> No más propiedades para mostrar </center></div>


</div>
</div><!--	wrapper	-->
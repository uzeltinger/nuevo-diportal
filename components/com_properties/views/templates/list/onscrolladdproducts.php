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
$params = $this->params;
$LinkHelper = new LinkHelper();
$propertyItemID=$LinkHelper->getItemid('property');
$mapItemID=$LinkHelper->getItemid('map');
$contactItemID=$LinkHelper->getItemid('contact');
$imagePath = 'images/properties/images/';

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
      // jQuery('body').removeClass('modal-open');
   });
});
JS;

$doc = JFactory::getDocument();

$doc->addScriptDeclaration($js);

if($this->pagination){
$variable = "var pagesTotal = ".$this->pagination->pagesTotal.";";
}

$js = <<<JS
(function ($) 
	{
	var processing = false;
	var calls = 1;
	$variable
	
		$(window).scroll(function()
		{
		
		if(calls < pagesTotal)
        {
		
		   // if($(window).scrollTop() == $(document).height() - $(window).height()){
			if ($(window).scrollTop() >= $(document).height() - $(window).height() - 500) {
			//$("#postswrapper").append($(window).scrollTop() + ' <br> ' );
			
		    	$('div#loadmoreajaxloader').show();
				//$("#postswrapper").append($(document).height());
				if (processing)	{return false;}
				processing = true;
					request = {
					'option' : 'com_properties',
					'view' : 'properties',					
					'format' : 'ajax',
					'start' : calls + '0',
					'limitstart' : calls + '0',
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
						processing = false;
					}	
									
				});
				//processing = true;
		    }/*	if ($(window).scrollTop()	*/
		
		}/*	if(calls <= pagesTotal)	*/
		
			
		});/*	$(window).scroll(function()	*/
		
	})(jQuery);/*	function ($) 	*/
JS;
$doc->addScriptDeclaration($js);
?>
<div id="postswrapper">
<?php
    $k = 0;
	for ($i_p=0, $n=count( $this->items ); $i_p < $n; $i_p++)	
    {
$row = $this->items[$i_p];	
$row->cat_currency=null;
$link = $this->getPropertyViewLink($row);
//print_r($this->Images[$row->id]);

$imageData = $this->Images[$row->id][0];

$style = '';

if($row->profile_published & $row->profile_show)
{
if($row->profile_logo_image)
	{
	$style = 'style="background: url(images/properties/profiles/'.$row->profile_logo_image.') no-repeat top right;"';
	}
}

$style = '';

?>
<div class="product">
<?php //echo $row->profile_logo_image;?>
<div class="product_agent <?php //echo $row->profile_alias;?>" <?php echo $style;?>>
	<div class="product_inner">    
		<div class="product_header">
        	<div class="product_title">
            	<h2>
                	<a href="<?php echo $link;?>"><?php echo $row->name;?></a>
                </h2>   
            </div>
        </div>  
        
        
        <div class="row">
        	<div class="col-sm-4">
            <div class="product_image">
        <img class="img-responsive" src="<?php echo $imagePath.$imageData->parent.'/'.$imageData->name;?>" alt="<?php echo $imageData->name;?>" />
        	</div>
            </div>
            
            <div class="col-sm-8">     
            	
                <div class="product_renglon_detalle">
        			<?php echo $row->ref.' '.$row->name_type.' '.$row->name_category.'. '.$row->address.', '.$row->name_locality.'.';?>
                    <br />
                    <?php echo $row->capacity.' ';echo $row->capacity == 1 ? JText::_('Persona') : JText::_('Personas'); ?>
                    <?php echo $row->bedrooms.' ';echo $row->bedrooms == 1 ? JText::_('Dormitorio') : JText::_('Dormitorios'); ?>
                    
        		</div>
                                       
            	<div class="product_description">
        		<?php echo substr(strip_tags($row->text),0,300).' ...';?>
        		</div>
                
                
                
        	</div>
        </div>    
        <div class="row">   
         
            <div class="col-sm-4 list-button-more-left">
            
            </div>
            
            <div class="col-sm-4 list-button-more-center">
           	 <button type="button" class="btn btn-info btn-md btn-block btn-contactar" data-toggle="modal" data-target="#myContactModal" data-id="<?php echo str_replace('"',' ',$row->id); ?>" data-name="<?php echo str_replace('"',' ',$row->name); ?>">Contactar</button>
            </div>
            
            <div class="col-sm-4 list-button-more-right">
            <a class="btn btn-md btn-success btn-block" href="<?php echo $link;?>" title="">Ver Detalles</a>
            </div>
            
        </div>
        
        
        
        
        
      
        
        
  <?php
if(isset($product_details)){
?>       
        
<div class="product_details">    
     
     <div class="details_extras_text">
     <div class="details_extras_text_inner">
<?php
	$ex = null;
	$extras = null;
	 $ex = (array)$row;	 
	 
	 $z=0;
	 for($i=1;$i<11;$i++)
	 	{		
		if($ex['extratext'.$i])
			{
			 $extras[$z]['title'] = '';
			 $extras[$z]['value'] = $ex['extratext'.$i];
			 $extras[$z]['id'] = $i;
			 $z++;
			}
	 	}
	 for($i=1;$i<41;$i++)
	 	{		
		if($ex['extra'.$i])
			{
			 $extras[$z]['title'] = '';
			 $extras[$z]['value'] = JText::_('PROPERTIES_DETAIL_EXTRA_'.$i);
			 $extras[$z]['id'] = $i;
			 $z++;
			}
	 	}	 

		$extrasTotal = count($extras);
		
		if($extrasTotal%2==0){$extrasMiddle = $extrasTotal/2;}else{$extrasMiddle = (int)(($extrasTotal/2)+1);}
		 ?> 
     <ul class="details_extras">
     <?php
	 for($x=0;$x<$extrasMiddle;$x++)
	 	{
		echo '<li>'.$extras[$x]['title'].$extras[$x]['value'].' </li>';		
		}	  	 
	 ?> 
     </ul>
     
     <ul class="details_extras">
     <?php
	 for($x=$extrasMiddle;$x<$extrasTotal;$x++)
	 	{
		echo '<li>'.$extras[$x]['title'].''.$extras[$x]['value'].' </li>';
		}	  	 
	 ?> 
     </ul>   
    </div>
    </div>
</div>
      
      
<?php
}
?>   
        
    
		</div>     <!--product_inner-->  
    </div>         <!--product_agent-->          
</div>  <!--product -->   



<?php
$k = 1 - $k;
}
?>


</div><!--	postswrapper	-->


 
<?php

//print_r($this->pagination);

if(isset($showPagination))
{
if($this->pagination){
?>  
<div class="pagination">	
	  <?php echo $this->pagination->getPagesLinks(); ?>
 	<div style="clear: both;"></div>
<p class="counter">
      <?php echo $this->pagination->getResultsCounter().' | '.$this->pagination->getPagesCounter(); ?>
</p>           
<div style="clear: both;"></div> 
</div>
<?php
}
}
?>


<?php
if(JRequest::getVar('format') != 'ajax')
{
?>

<div style="width:100%; height:100px; float:left">
<div id="loadmoreajaxloader" style="display: none; background:url(media/com_properties/img/ajax-loader.gif) center center no-repeat;"> &nbsp; </div>
<div id="loadmoreajaxnomore" style="display: none;"><center> No más propiedades para mostrar </center></div>
</div>






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
}
?>
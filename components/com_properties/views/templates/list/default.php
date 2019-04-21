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

$doc = JFactory::getDocument();
?>

<div class="propertieslist">
<?php
    $k = 0;
	for ($i_p=0, $n=count( $this->items ); $i_p < $n; $i_p++)	
    {
$row = $this->items[$i_p];	
$row->cat_currency=null;
$link = $this->getPropertyViewLink($row);
$imageSrc = "";
$imageName = $row->alias;
if(isset($this->Images[$row->id][0])){
	if($imageData = $this->Images[$row->id][0]){
		$imageSrc = $imagePath.$imageData->parent.'/'.$imageData->image;
	}
}
$style = '';

?>
<div class="product">
<div class="product_agent">
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
			<a href="<?php echo $link;?>">
				<div class="product_image">
					<img class="img-fluid" src="<?php echo $imageSrc;?>" alt="<?php echo $imageName;?>" />
				</div>
				</a>
            </div>
            
            <div class="col-sm-8 product-right-text">     
            	
                <div class="product_renglon_detalle">
        			<?php echo $row->name_type.' '.$row->name_category.'. '.$row->address.', '.$row->name_locality.'.';?>
                    <br />
                    
					<?php 
					if($row->bedrooms>0){
						echo $row->bedrooms.' ';echo $row->bedrooms == 1 ? JText::_('COM_PROPERTIES_LIST_BEDROOM') : JText::_('COM_PROPERTIES_LIST_BEDROOMS'); 
					}
					
					?>
					<?php 
					if($row->bathrooms>0){
						echo $row->bathrooms.' ';echo $row->bathrooms == 1 ? JText::_('COM_PROPERTIES_LIST_BATHROOM') : JText::_('COM_PROPERTIES_LIST_BATHROOMS');
					}
					?>
             
        		</div>
                                       
            	<div class="product_description">
        			<?php echo substr(strip_tags($row->text),0,300).' ...';?>
        		</div>                
            
				<div class="product_botones">
					<div class="list-button-more-right float-right">
						<a class="btn btn-small btn-black btn-block" href="<?php echo $link;?>" title="">Ver Detalles</a>
					</div>
					
					<div class="list-button-more-right float-right consultar-whatsapp">
						<a class="btn btn-small btn-success boton-whatsapp" target="_blank" data-action="share/whatsapp/share" href="https://api.whatsapp.com/send?phone=542914051284&amp;text=Hola,%20me%20das%20más%20información%20por%20favor.%0AMuchas%20gracias.%0A<?php echo 'http://www.filipponepropiedades.com'.$link;?>"><i class="fab fa-whatsapp"></i>  </a>
					</div>
				</div>
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

if($this->pagination){
?>  
<nav aria-label="...">

<?php echo $this->pagination->getPagesLinks(); ?>

</nav>

<?php
}
?>


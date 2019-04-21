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

$mostrarme=true;
if($mostrarme)
	{
?>
<div class="property_details">
	<div id="property_details_inner">    
		<div class="topdetail">
			<div class="ProductTitle">
    			<h1>
					<?php echo $Product->name;?>
                </h1>
			</div>
    	</div>        

        <div class="row">
        	<div class="col-sm-5">
            	<div class="product_image">
            		<img class="img-fluid" src="<?php echo $rout_image.$image1;?>" alt="<?php echo $Product->name;?>" />
            	</div>
            </div>            

            <div class="col-sm-7">
				<div class="details_left">
					<?php 					
					if($Product->ref && $ShowReferenceInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_REFERENCE').' : '.$Product->ref;?>
					</div>
					<?php }?>
					<?php if($Product->name_category && $ShowCategoryInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_CATEGORY').' : '.$Product->name_category;?>
					</div>
					<?php }?>
					<?php if($Product->name_type && $ShowTypeInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_TYPE').' : '.$Product->name_type;?>
					</div>
					<?php }?>

					<?php if($Product->name_state && $ShowStateInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_STATE').' : '.$Product->name_state;?>
					</div>
					<?php }?>            

					<?php if($Product->name_locality && $ShowLocalityInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_LOCALITY').' : '.$Product->name_locality;?>
					</div>
					<?php }?>             

					<?php if($Product->address && $ShowAddressInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_ADDRESS').' : '.$Product->address;?>
					</div>
					<?php }?>        	 	

            
					<?php if($Product->years && $ShowYearsInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_YEARS').' : '.$Product->years;?>
					</div>
					<?php }?> 

 					<?php if($Product->capacity && $ShowCapacityInDetail){ ?>
        			<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_CAPACITY').' : '.$Product->capacity;?>
					</div>
					<?php }?>        

 					<?php if($Product->capacity && $ShowRoomsInDetail){ ?>
        			<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_ROOMS').' : '.$Product->rooms;?>
					</div>
					<?php }?>       

 					<?php if($Product->bedrooms && $ShowBedroomsInDetail){?>        
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_BEDROOMS').' : '.$Product->bedrooms;?>
					</div>
					<?php }?>        

 					<?php if($Product->bathrooms && $ShowBathroomsInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_BATHROOMS').' : '.$Product->bathrooms;?>
					</div>
					<?php }?>        

 					<?php if($Product->garage && $ShowGarageInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_GARAGE').' : '.$Product->garage;?>
					</div>
					<?php }?>        

 					<?php if($Product->area && $ShowTotalAreaInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_TOTAL_AREA').' : '.$Product->area.' '.JText::sprintf('COM_PROPERTIES_DETAIL_SIMBOL_AREA');?>
					</div>
					<?php }?>        

 					<?php if($Product->covered_area && $ShowCoveredAreaInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_COVERED_AREA').' : '.$Product->covered_area.' '.JText::sprintf('COM_PROPERTIES_DETAIL_SIMBOL_AREA');?>
					</div>
					<?php }?>        

  					<?php if($Product->available && $ShowDetailsMarketInDetail){?>
					<div class="details_field">
					<?php echo JText::_('COM_PROPERTIES_DETAIL_DETAILS_MARKET').' : '.JText::sprintf('COM_PROPERTIES_DETAIL_DETAILS_MARKET'.$Product->available);?>
					</div>
					<?php }?>        

        		</div>       

				<div class="details_right">
        			<div class="details_extras_text">
     					<div class="details_extras_text_inner">

						 <div class="list-button-more-right float-right consultar-whatsapp">
                    <a class="btn btn-success boton-whatsapp" target="_blank" data-action="share/whatsapp/share" href="https://api.whatsapp.com/send?phone=541130190242&amp;text=Hola,%20me%20das%20más%20información%20por%20favor.%0AMuchas%20gracias.%0A<?php echo substr(JUri::base(), 0, -1).$this->item->link;?>"><i class="fab fa-whatsapp"></i> Consultar </a>
                </div>
				
 	<?php
	 $ex = (array)$Product;
	 $z=0;
	 $extras = [];
	 for($i=1;$i<10;$i++)
	 	{		
		if($ex['extratext'.$i])
			{
			 $extras[$z]['title'] = JText::_('COM_PROPERTIES_DETAIL_EXTRATEXT_'.$i).' : ';
			 $extras[$z]['value'] = $ex['extra'.$i];
			 $extras[$z]['id'] = $i;
			 $z++;
			}
	 	}		

	 for($i=1;$i<41;$i++)
	 	{		
		if($ex['extra'.$i])
			{
			 $extras[$z]['title'] = '';
			 $extras[$z]['value'] = JText::_('COM_PROPERTIES_DETAIL_EXTRA_'.$i);
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

     <?php
	 for($x=$extrasMiddle;$x<$extrasTotal;$x++)
	 	{
		echo '<li>'.$extras[$x]['title'].''.$extras[$x]['value'].' </li>';
		}	  	
	 ?> 
     </ul>   
    					</div>
    				</div>
            	</div><!--	details_right	-->
			</div>
		</div><!--	clas="row"	-->
                 
<div class="row">
	<div class="col-sm-12">
    	<div class="details_description general_details">
    		<div class="details_description_inner">            
            	<div class="titleExtras"><?php echo JText::_('COM_PROPERTIES_TITLE_DETAILS');?></div>
				<?php echo $Product->text; ?>
    		</div>
    	</div>
    </div>
</div>
    
<div style="clear:both; width:100%; height:20px;"></div>

<div class="row">
	<div class="col-sm-12">
    	<div class="details_description general_details">
    		<div class="details_description_inner">    
				<div class="titleExtras"><?php echo JText::_('COM_PROPERTIES_TITLE_IMAGES');?></div>

<div class="d-none d-lg-block">
	<div class="row gallery">
		<?php
		foreach($this->itemimages as $image){
		?>
		<div class="col-sm-3">
		<a href="<?php echo $rout_image.$image->image; ?>" class="thumbnail" rel="prettyPhoto[gallery1]" title="<?php echo $Product->name; ?>">
		<!--<p>Pulpit Rock: A famous tourist attraction in Forsand, Ryfylke, Norway.</p>-->
		<div class="detalleimagenfondo" style="background-image: url('<?php echo $rout_image.$image->image; ?>');">&nbsp;</div>
		<!--<img class="thumb" name="leaf" src="<?php echo $rout_image.$image->image; ?>" alt="<?php echo str_replace('"',' ',$Product->name); ?>" style="width:100%;height: auto">-->
		</a>
		</div>
		<?php } ?>
	</div><!-- gallery -->            
</div>
<div class="d-lg-none">
<?php
		foreach($this->itemimages as $image){
		?>
		<div class="mobile-photo">
		<img class="thumb" name="leaf" src="<?php echo $rout_image.$image->image; ?>" alt="<?php echo str_replace('"',' ',$Product->name); ?>" style="width:100%;height: auto">		
		</div>
		<?php } ?>
</div>
      		</div>
    	</div>
    </div>
</div>          
            

<!--
<script src="<?php echo $this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js';?>"></script>    
 -->
<script type="text/javascript" charset="utf-8">
			jQuery(document).ready(function(){				
				jQuery(".gallery a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:5000, autoplay_slideshow: true});				
			});
</script>
   

<div style="clear:both"></div>


<?php if($ActiveMap == 1 & $ShowMapInDetail) : 
$MapApiKey=$params->get('MapApiKey');
$MapDistance=$params->get('MapDistance',15);
$lat = $Product->lat;
$lng = $Product->lng;
?> 

<div style="clear:both; width:100%; height:20px;"></div>

<div class="row">
	<div class="col-sm-12">
    	<div class="details_description general_details">
    		<div class="details_description_inner">              
            	<div class="titleExtras"><?php echo JText::_('COM_PROPERTIES_TITLE_MAP_UBICATION');?></div>
<div class="mapa_propertysection" >

<iframe src="https://maps.google.com/maps?q=<?php echo $Product->lat;?>,<?php echo $Product->lng;?>&z=15&output=embed" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

	
<!--
     <div class="mapa_inner">
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
     <script>
function initialize() {
  var myLatlng = new google.maps.LatLng(<?php echo $Product->lat; ?>  , <?php echo $Product->lng; ?>);
  var mapOptions = {
    zoom: <?php echo $MapDistance; ?>,
	scrollwheel: false,
    center: myLatlng
  }
var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
var iconBase = '<?php echo JURI::root();?>media/com_properties/images/';
var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
	  icon: iconBase + 'markerHouse.png',
      title: ''
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<div id="map-canvas" style="width:100%; height: 350px;"></div>
	</div>

-->
    </div>
    
    		</div>
    	</div>
    </div>
</div>    
    
    
  <?php endif; ?>



<?php 
//print_r($Profile);
if($ShowContactInfoDetail == 1) :?> 
<?php if($Profile) :?> 


<div style="clear:both; width:100%; height:20px;"></div>

<div class="row">
	<div class="col-sm-12">
    	<div class="details_description general_details">
    		<div class="details_description_inner">             
            	<div class="titleExtras"><?php echo JText::_('COM_PROPERTIES_TITLE_CONTACT_DETAILS');?></div>
	
<div class="details_contact">
	<div class="tools_agent row">
		
		<div class="tools_image col-sm-12 col-lg-3">
		<img class="agent" align="left" src="<?php echo JURI::root().'images/properties/profiles/'.$Profile->logo_image; ?>" />
		</div>
		<div class="col-sm-12 col-lg-9">
			<div class="tools_company"><?php echo $Profile->name;?></div>
			<div class="tools_address"><?php echo $Profile->address1.', '.$Profile->pcode. ' ' .$Profile->locality;?></div>
			<div class="tools_info">		
				<?php echo $Profile->phone;?>
			</div>		
			<div class="tools_info">
			<?php $mail_img='<img class="at" align="absmiddle" src="'.JURI::root().'media/com_properties/images/at.png" width="20" height="15">'; $css=str_replace('@',$mail_img,$Profile->email);
	echo $css;?>
			</div>
		</div>
	</div>
</div><!-- details_contact -->

    		</div>
    	</div>
    </div>
</div>


<?php endif; ?> 
<?php endif; ?> 

</div><!-- property_details -->
</div><!-- property_details inner-->
<div style="clear:both"></div>
<?php
}else{
echo '';
}
?>
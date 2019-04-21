<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

			
			 if(!$this->item->id)
				  	{
					echo JText::_('COM_PROPERTIES_SAVE_DATA_TO_ADD_IMAGES');
					}
					
if($this->item->id){ 
$UploadImagesSystem=1;
if($UploadImagesSystem==1){ ?>

   <script type="text/javascript">
	/*jQuery.noConflict();*/
	
	jQuery(function() {
		jQuery("#thumbnails").sortable({update: function(){ 
		/*var order = jQuery(this).sortable("serialize");*/
		var resultado = jQuery('#thumbnails').sortable('toArray');
		var mostrar = '';
		var x = 0;
		var myorden = new Array();
		for(x=0;x<resultado.length;x++)
			{
			mostrar = mostrar+resultado[x];
			myorden[x]=resultado[x];
			}
		document.getElementById("myOrden").value=myorden;
		/*ordenar(resultado);*/
		/*jQuery("#contentRight").html(mostrar); */
		} });
		jQuery("#thumbnails").disableSelection();
	});
	
	
	
	
	function removeImgElement(divNum) {
  var d = document.getElementById('thumbnails');
  var olddiv = document.getElementById(divNum);
  d.removeChild(olddiv);
}
	</script>
 
      <script type="text/javascript">
    <!--

    jQuery(function () {
        jQuery('.bubbleInfo').each(function () {
            var distance = 10;
            var time = 250;
            var hideDelay = 500;

            var hideDelayTimer = null;

            var beingShown = false;
            var shown = false;
            var trigger = jQuery('.trigger', this);
            var info = jQuery('.popup', this).css('opacity', 0);


            jQuery([trigger.get(0), info.get(0)]).mouseover(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                if (beingShown || shown) {
                    // don't trigger the animation again
                    return;
                } else {
                    // reset position of info box
                    beingShown = true;

                    info.css({
                        top: -20,
                        left: -20,
						right: -20,
                        display: 'block'
                    }).animate({
                        top: '-=' + distance + 'px',
                        opacity: 1
                    }, time, 'swing', function() {
                        beingShown = false;
                        shown = true;
                    });
                }

                return false;
            }).mouseout(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                hideDelayTimer = setTimeout(function () {
                    hideDelayTimer = null;
                    info.animate({
                        top: '-=' + distance + 'px',
                        opacity: 0
                    }, time, 'swing', function () {
                        shown = false;
                        info.css('display', 'none');
                    });

                }, hideDelay);

                return false;
            });
        });
    });
 
    //-->
    </script>
  
     <style type="text/css" media="screen">
    <!--
        
             
        .bubbleInfo {
            position: relative;
           
           
        }
        .trigger {
           /* position: absolute;*/
        }
     
        /* Bubble pop-up */
		.adminform table.popup {
        	position: absolute;
        	display: none;
        	z-index: 50;
        	border-collapse: collapse;
			bottom:50px;
        }
		
		.adminform table.popup td {
		margin: 0;
            padding: 0;
		}
		
		

        .popup {
        	position: absolute;
        	display: none;
        	z-index: 50;
        	border-collapse: collapse;
			bottom:50px;
        }
		
		.popup td {
		margin: 0;
            padding: 0;
		}

        .popup td.corner {
        	height: 15px;
        	width: 19px;
			margin: 0;
            padding: 0;
        }

        .popup td#topleft { background-image: url(components/com_properties/includes/img/bubble-1.png); }
        .popup td.top { background-image: url(components/com_properties/includes/img/bubble-2.png); }
        .popup td#topright { background-image: url(components/com_properties/includes/img/bubble-3.png); }
        .popup td.left { background-image: url(components/com_properties/includes/img/bubble-4.png); }
        .popup td.right { background-image: url(components/com_properties/includes/img/bubble-5.png); }
        .popup td#bottomleft { background-image: url(components/com_properties/includes/img/bubble-6.png); }
        .popup td.bottom { background-image: url(components/com_properties/includes/img/bubble-7.png); text-align: center;}
        .popup td.bottom img { display: block; margin: 0 auto; }
        .popup td#bottomright { background-image: url(components/com_properties/includes/img/bubble-8.png); }

        .popup table.popup-contents {
        	font-size: 12px;
        	line-height: 1.2em;
        	background-color: #fff;
        	color: #666;
        	font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", sans-serif;
        	}

        table.popup-contents th {
        	text-align: right;
        	text-transform: lowercase;
			width: 20px;
        	}

        table.popup-contents td {
        	text-align: left;
        	}

        tr.editar th {
        	text-align: left;
        	text-indent: -9999px;
        	background: url(components/com_properties/includes/img/starburst.gif) no-repeat top right;
        	height: 17px;
        	}
			
		tr.borrar th {
        	text-align: left;
        	text-indent: -9999px;
        	background: url(components/com_properties/includes/img/starburst.gif) no-repeat top right;
        	height: 17px;
        	}

        tr#editar td a {
        	color: #333;
        }
        
    -->
    </style>
     

  

      
<?php

$img_path = JURI::root().'images/properties/images/'.$this->item->id.'/';
$peque_path = JURI::root().'images/properties/images/thumbs/'.$this->item->id.'/';

//print_r($this->Images);

?>
<div class="div_thumbs_all">                  
  <div id="thumbnails">
 
<?php  
  
if($this->Images){
$totalImages=count($this->Images);
if($this->Profile->canaddimages<$totalImages)
	{
	//echo '<div style="width:100%;float:left;color:red;">'.JText::_('only will show first').' '.$this->Profile->canaddimages.' '.JText::_('images ').'</div>';
	}

foreach ($this->Images as $Image) {				
//					echo '<a id="' . $Image->name . '" class="no_modal je_thumbnail" href="'.JURI::root().'images/com_properties/gallery/' . $this->Gallery->id . '/' . $Image->name . '" target="_blank"> ';
echo '<div class="thumb bubbleInfo" id="' . $Image->name . '">';
echo '<div>';
					echo '<img width="100px" height="75px" class="trigger" id="22' . $Image->name . '" src="'.JURI::root().'images/properties/images/thumbs/' . $this->item->id . '/' . $Image->name . '" />';
echo '</div>';	
?>

<table style="opacity: 0; top: -110px; left: -33px; display: none;" id="dpop" class="popup">
        	<tbody><tr>
        		<td id="topleft" class="corner"></td>
        		<td class="top"></td>
        		<td id="topright" class="corner"></td>
        	</tr>
        	<tr>
        		<td class="left"></td>
        		<td><table class="popup-contents">
        			<tbody>
                    <tr class="borrarr">
        				<th>
                        <input type="checkbox" name="deleteimage[<?php echo $Image->name;?>]" id="deleteimage<?php echo $Image->name;?>"  />
                        </th>
        				<td>
                     <?php echo JText::_('Select to delete this image');?>
                     </td>
        			 </tr>        			
        		</tbody></table>
        		</td>
        		<td class="right"></td>    
        	</tr>
        	<tr>
        		<td class="corner" id="bottomleft"></td>
        		<td class="bottom"><img alt="popup tail" src="components/com_properties/includes/img/bubble-tail2.png" width="30" height="29"></td>
        		<td id="bottomright" class="corner"></td>
        	</tr>
        </tbody></table>

<?php
echo '</div>';
//					echo '</a>';
				
			}



}
?>
	</div> 
 </div>  


<div style="clear:both"></div>

<br><br>


<?php }else{?>


<?php $linkI = JRoute::_( 'index.php?option=com_properties&view=images&product_id='. $this->item->id);?>
 <div style="width:100%;">
 <a href="<?php echo $linkI;  ?>"><?php echo JText::_('Edit Images'); ?></a>        
 </div>       
<?php

$img_path = JURI::root().'images/properties/images/'.$this->item->id.'/';
$peque_path = JURI::root().'images/properties/images/thumbs/'.$this->item->id.'/';

//print_r($this->Images);
if($this->Images){
foreach($this->Images as $image){
echo '<img width="100px" style="padding: 2px; border: 1px solid #CCCCCC; margin:5px;" src="'.$peque_path.$image->name.'" />';
}
}
?>

<?php } ?>

<?php } ?>




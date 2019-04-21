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
<div class="container-fluid">
<div class="row">

<?php
for ($i = 0, $n = count($list); $i < $n; $i ++) :
$item = $list[$i]; 
?>


<div class="colo-12 col-md-6 col-lg-6 col-xl-6">
    <!-- Product Classic-->
    <article class="product-classic">
        <div class="product-classic-media">
		
            <div class="owl-carousel owl-loaded">
                <a href="<?php echo $item->link;?>">
					<div class="imagenfondo" style="background-image: url('<?php echo $item->image; ?>');">&nbsp;</div>
                </a>
            </div>
            <div class="product-classic-price"><span><?php echo $item->name_type.' '.$item->name_category;?></span></div>
        </div>
        <h4 class="product-classic-title"><a href="<?php echo $item->link;?>">
			
		<?php echo str_replace('"',' ',$item->name);?>

		</a></h4>
        <div class="product-classic-divider"></div>
        <!--
        <ul class="product-classic-list">
            <li><span class="icon hotel-icon-10"></span><span><?php echo $item->bedrooms.' ';echo $item->bedrooms == 1 ? JText::_('Dormitorio') : JText::_('Dormitorios'); ?></span></li>
            <li><span class="icon hotel-icon-05"></span><span><?php echo $item->bathrooms.' ';echo $item->bathrooms == 1 ? JText::_('Baño') : JText::_('Baños'); ?></span></li>
		</ul>
		-->
		<div class="product-classic-footer">
			<div class="row"><!--
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">					
                    <div class="list-button-more-right float-left">
					<a class="btn btn-md btn-black btn-block" href="<?php echo $item->link;?>" title="">Ver Detalles</a>                   
				    </div>     
				</div>-->
                <div class="col-4">
                <span class="icon hotel-icon-10"></span><span><?php 
                if($item->bedrooms>0){
                    echo $item->bedrooms.' ';echo $item->bedrooms == 1 ? JText::_('Dormitorio') : JText::_('Dormitorios'); 
                }
                ?></span>
                </div>
                <div class="col-4">
                <span class="icon hotel-icon-05"></span><span><?php 
                if($item->bathrooms>0){
                    echo $item->bathrooms.' ';echo $item->bathrooms == 1 ? JText::_('Baño') : JText::_('Baños'); 
                }?></span>
                </div>
				<div class="col-4">
                    <div class="list-button-more-right float-right consultar-whatsapp">
                        <a class="btn btn-success boton-whatsapp" target="_blank" href="https://api.whatsapp.com/send?phone=542914051284&amp;text=Hola,%20me%20das%20más%20información%20por%20favor.%0AMuchas%20gracias.%0A<?php echo 'http://www.filipponepropiedades.com'.$item->link;?>"><i class="fab fa-whatsapp"></i> Consultar </a>
                    </div>
				</div>
			</div>
		</div>
		
    </article>
</div>
					



































<?php endfor; ?>
<div class="col-12 align-center"><a class="btn btn-danger btn-small vertodas" href="./propiedades.html">Ver todas las propiedades</a></div>
</div>
</div>
</div>
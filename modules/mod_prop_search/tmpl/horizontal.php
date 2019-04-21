<?php
/**
* @copyright	Copyright(C) 2008-2012 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;
$lid = Jrequest::getInt('l',0);
?>
<div class="container modpropsearch-horizontal<?php echo $params->get('moduleclass_sfx'); ?>">
<div class="home-search fadeInLeft animated">
<h3 class="topsearchtitle">
Encuentre su propiedad de forma rápida y sencilla
</h3>
<form action="<?php echo JRoute::_('index.php?option=com_properties&view=properties&Itemid=106'); ?>" method="get" id="searchForm" name="searchForm" class="form_search_ajax searchFormVertical" >
<input type="hidden" name="option" id="option" value="com_properties" />
<input type="hidden" name="view" id="view" value="properties" />
<input type="hidden" name="task" id="task" value="search" />
<input type="hidden" name="Itemid" id="Itemid" value="106" />

<div class="AjaxSearchForm">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                <label for="select-search-1" class="form-label rd-input-label focus not-empty">Operación</label>
                <div class="combo"><?php echo $ComboCategories;?></div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                <label for="select-search-1" class="form-label rd-input-label focus not-empty">Tipo de propiedad</label>
                <div class="combo"><?php echo $ComboTypes;?></div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                <label for="select-search-1" class="form-label rd-input-label focus not-empty">Habitaciones</label>
                <div class="combo"><?php echo $comboBeds;?></div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                <label for="select-search-1" class="form-label rd-input-label focus not-empty">Baños</label>
                <div class="combo"><?php echo $comboBaths;?></div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                <label for="select-search-1" class="form-label rd-input-label focus not-empty">Ciudad</label>
                <div class="combo"><?php echo $comboStates;?></div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="form-group">
                <label for="select-search-1" class="form-label rd-input-label focus not-empty">Barrio</label>
                <div class="combo">
                    <select id="l" name="l" class="form-control locality">
                        <option value="0">Cualquiera</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3"></div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="form-group">
                <label for="select-search-1" class="form-label rd-input-label focus not-empty"> </label>
                    <button type="submit" class="button btn btn-success btn-block"><?php echo JText::_('Encontrar'); ?></button>
                </div>
            </div>
        </div>

   




<?php  ?>
</div><!--AjaxSearchForm-->
</form>
</div>
</div>

<div style="clear:both; width:100%; float:left;"> </div>

<script>
jQuery(document).ready(function ($){
    $(function() {
        /*
    var selectValues = {
        "1": {
            "N97": "http://www.google.com",
            "N93": "http://www.stackoverflow.com"
        },
        "2": {
            "M1": "http://www.ebay.com",
            "M2": "http://www.twitter.com"
        }
    };
*/
    var selectValues =<?php echo $listLocalities;?>;

    var vendor = $('#s');
    var model = $('#l');
    var inicio = true;
/*
    model.empty().append(function() {
            var output = '<option>Cualquiera</option>';
            $.each(selectValues[vendor.val()], function(key, value) {
                output += '<option value="'+value.id+'">' + value.name + '</option>';
            });
            return output;
        });
        */
    vendor.change(function() {
        console.log('anda');
        model.empty().append(function() {
            var output = '<option value="0">Cualquiera</option>';
            $.each(selectValues[vendor.val()], function(key, value) {
                output += '<option value="'+value.id+'">' + value.name + '</option>';
            });
            return output;
        });
        if(inicio){
            $('#l').val( <?php echo $lid;?> );//To select Blue
            inicio = false;
        }
    }).change();

    // bonus: how to access the download link
    model.change(function() {
        //$('#download-link').attr('href', selectValues[vendor.val()][model.val()]).show();
    });
});
});
</script>
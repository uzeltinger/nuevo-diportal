<?php
/**
* @copyright	Copyright(C) 2008-2012 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;
?>
<script language="javascript" type="text/javascript">
function goSearchAjax(){
document.getElementById('task').value = 'ModuleSearchAjax.goSearchAjax';
document.searchForm.submit();
}
</script>
<div class="modpropsearch-vertical<?php echo $params->get('moduleclass_sfx'); ?>">
<div class="searchform">
<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="searchForm" name="searchForm" class="form_search_ajax searchFormVertical" >
<input type="hidden" name="tmpl" value="component" />
<input type="hidden" name="option" id="option" value="com_properties" />
<input type="hidden" name="task" id="task" value="ModuleSearchAjax.show" />
<input type="hidden" name="Itemid" id="Itemid" value="<?php echo JRequest::getInt('Itemid');?>" />
<!--<input type="hidden" name="format" id="format" value="raw" />-->

<input type="hidden" name="moduleId" id="moduleId" value="<?php echo $module->id;?>" />

<div id="AjaxSearchForm">
<input type="hidden" name="cyid" id="cyid" value="<?php echo JRequest::getInt('cy');?>" />
<input type="hidden" name="sid" id="sid" value="<?php echo JRequest::getInt('s');?>" />
<input type="hidden" name="lid" id="lid" value="<?php echo JRequest::getInt('l');?>" />
<input type="hidden" name="cid" id="cid" value="<?php echo JRequest::getInt('c');?>" />
<input type="hidden" name="tid" id="tid" value="<?php echo JRequest::getInt('t');?>" />
<input type="hidden" name="bedrooms" id="bedrooms" value="<?php echo JRequest::getInt('bd');?>" />
<input type="hidden" name="bathrooms" id="bathrooms" value="<?php echo JRequest::getInt('bt');?>" />
<input type="hidden" name="garage" id="garage" value="<?php echo JRequest::getInt('g');?>" />
<input type="hidden" name="minprice" id="minprice" value="<?php echo JRequest::getInt('minprice');?>" />
<input type="hidden" name="maxprice" id="maxprice" value="<?php echo JRequest::getInt('maxprice');?>" />
<input type="hidden" name="minarea" id="minarea" value="<?php echo JRequest::getInt('minarea');?>" />
<input type="hidden" name="maxarea" id="maxarea" value="<?php echo JRequest::getInt('maxarea');?>" />
<input type="hidden" name="minareacov" id="minareacov" value="<?php echo JRequest::getInt('minareacov');?>" />
<input type="hidden" name="maxareacov" id="maxareacov" value="<?php echo JRequest::getInt('maxareacov');?>" />
<input type="hidden" name="e1" id="e1" value="<?php echo JRequest::getInt('e1');?>" />
<input type="hidden" name="e2" id="e2" value="<?php echo JRequest::getInt('e2');?>" />
<input type="hidden" name="e3" id="e3" value="<?php echo JRequest::getInt('e3');?>" />
<input type="hidden" name="e4" id="e4" value="<?php echo JRequest::getInt('e4');?>" />
<input type="hidden" name="e5" id="e5" value="<?php echo JRequest::getInt('e5');?>" />
<input type="hidden" name="e6" id="e6" value="<?php echo JRequest::getInt('e6');?>" />
<input type="hidden" name="e7" id="e7" value="<?php echo JRequest::getInt('e7');?>" />
<input type="hidden" name="e8" id="e8" value="<?php echo JRequest::getInt('e8');?>" />
<input type="hidden" name="e9" id="e9" value="<?php echo JRequest::getInt('e9');?>" />
<input type="hidden" name="e10" id="e10" value="<?php echo JRequest::getInt('e10');?>" />

<?php 
	$badchars = array('#','>','<','\\'); 
		$textsearch = trim(str_replace($badchars, '', JRequest::getString('textsearch', null)));
		$currency = trim(str_replace($badchars, '', JRequest::getString('currency', null)));
?>
<input type="hidden" name="currency" id="currency" value="<?php echo $currency;?>" />
<input type="hidden" id="textsearch" name="textsearch" value="<?php echo $textsearch;?>" class="textsearch" />


<?php  ?>
</div><!--AjaxSearchForm-->

<input id="hiddeSubmitButton" type="submit" value="send" />



<?php echo JHTML::_('form.token'); ?>
</form>
<div id="progressSearchForm"></div>
</div>
<div style="clear:both"></div>
</div>

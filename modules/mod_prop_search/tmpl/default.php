<?php defined('_JEXEC') or die('Restricted access'); // no direct access 
?>
<script language="javascript" type="text/javascript">
function ModuleSearchAjax(){
document.getElementById('task').value = 'ModuleSearchAjax';
var progress = $('progressSearchForm');
new Ajax("<?php echo JURI::base();?>index.php?option=com_properties&controller=ModuleSearchAjax&format=raw&task=ModuleSearchAjax",
{method: 'post',
onRequest: function(){progress.setStyle('visibility', 'visible');},
onComplete: function(){progress.setStyle('visibility', 'hidden');},
evalScripts: true, 
update: $('AjaxSearchForm'), 
data: $('searchForm')}).request();
}

function goSearchAjax(){
document.getElementById('task').value = 'goSearchAjax';
document.searchForm.submit();
}

</script>
<div id="all_search">
<div id="inner_search" style=" <?php echo $divWidth;?>;">
<div class="inner_element_search" style=" <?php echo $selectWidth;?>;<?php echo $divHeight;?>">
<div class="searchform">

<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="searchForm" name="searchForm" class="form_search_ajax" onSubmit="return false">
<input type="hidden" name="option" id="option" value="com_properties" />
<input type="hidden" name="controller" id="controller" value="ModuleSearchAjax" />
<input type="hidden" name="task" id="task" value="ModuleSearchAjax" />
<input type="hidden" name="Itemid" id="Itemid" value="<?php echo JRequest::getInt('Itemid');?>" />

<div id="AjaxSearchForm">
<input type="hidden" name="cyid" id="cyid" value="<?php echo JRequest::getInt('cyid');?>" />
<input type="hidden" name="sid" id="sid" value="<?php echo JRequest::getInt('sid');?>" />
<input type="hidden" name="lid" id="lid" value="<?php echo JRequest::getInt('lid');?>" />
<input type="hidden" name="c" id="c" value="<?php echo JRequest::getInt('c');?>" />
<input type="hidden" name="t" id="t" value="<?php echo JRequest::getInt('t');?>" />
<input type="hidden" name="p" id="p" value="<?php echo JRequest::getInt('p');?>" />
<input type="hidden" name="d" id="d" value="<?php echo JRequest::getInt('d');?>" />
<input type="hidden" name="bathrooms" id="bathrooms" value="<?php echo JRequest::getInt('bathrooms');?>" />
<input type="hidden" name="parking" id="parking" value="<?php echo JRequest::getInt('parking');?>" />
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
<input type="text" id="textsearch" name="textsearch" value="<?php echo $textsearch;?>" class="textsearch" />
<?php  ?>

</div><!--AjaxSearchForm-->
<div class="divbuttonsearch">
<button type="button" class="button buttonsearch" id="buttonSearch" onclick="goSearchAjax();"><?php echo JText::_('Search'); ?></button>
</div>
<?php echo JHTML::_('form.token'); ?>
</form>

<div id="progressSearchForm"></div>
</div>
</div><!--inner_element_search_js-->
</div><!--inner_search_js --> 
</div>  <!--all_search_js -->
<div style="clear:both"></div>
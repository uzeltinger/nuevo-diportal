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

jimport('joomla.filesystem.file');	
$params		= JComponentHelper::getParams('com_properties');
//require_once( JPATH_COMPONENT.'/helpers/params.php' );
?>


<style type="text/css">


.formulario_contacto {
/*background: url(media/com_properties/img/monte_hermoso_playa_960x540.jpg) no-repeat top center;*/


}

.form-contact {
	height: 430px;
	padding: 10px 25px 30px 25px;
	/*background: #444;*/
	/*background: rgba(255, 255, 255, 0.4);*/
	-moz-border-radius: 0 0 4px 4px; -webkit-border-radius: 0 0 4px 4px; border-radius: 0 0 4px 4px;
	text-align: left;
	background: #F6EDD4 none repeat scroll 0% 0%;
border: 1px solid #F9AA4C;
}

.form-contact form textarea {
	height: 60px;
}

.form-contact form .input-error {
	border-color: #19b9e7;
}

</style>



<div class="formulario_contacto" style="width:100%; height: 430px;">
<div class="form-contact">
<form action="<?php echo JRoute::_( 'index.php' ); ?>" method="post" name="adminForm" id="adminForm">
	<div class="form-group">
		<label for="inputName">Su nombre</label>
		<input name="name" type="text" class="form-control" id="inputName" placeholder="Nombre">
	</div>  
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" placeholder="Email" class="form-email form-control" id="inputEmail">
	</div>                                    
	<div class="form-group">
		<label for="inputPhone">Telefono</label>
		<input name="phone" type="phone" class="form-control" id="inputPhone" placeholder="Telefono">
	</div>    
    <div class="form-group">
		<label for="inputPhone">Consulta</label>
		<textarea name="text" class="form-control" rows="3" id="textareaConsulta" placeholder="Sea lo mas detallado posible"></textarea>
	</div>
<div class="row"> 
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	<div class="checkbox">
		<label>
			<input type="checkbox" name="email_copy" checked="checked"> Quiero una copia del mail
		</label>
	</div>
	</div>
	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	<button type="submit" class="btn btn-danger">Enviar</button>
    </div>
</div>
<?php
$uri = JFactory::getURI(); 
$pageURL = $uri->toString(); 
?>
	<input type="hidden" name="return" value="<?php echo $pageURL;?>" />
	<input type="hidden" name="id" value="<?php echo JRequest::getInt('id');?>" />
	<input type="hidden" name="option" value="com_properties" />    
    <input type="hidden" name="controller" value="contact" />
	<input type="hidden" name="task" value="contact.send_contact" />
    <input type="hidden" name="product_id" value="<?php echo JRequest::getInt('id');?>" />
    <input type="hidden" name="modal" value="1" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
</div>
</div>
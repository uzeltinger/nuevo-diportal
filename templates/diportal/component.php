<?php
// No direct access.
defined('_JEXEC') or die;
if(!defined('DS')){
   define('DS',DIRECTORY_SEPARATOR);
}
/*  
require_once(dirname(__file__) . DS . 'framework' . DS . 'helper.cache.php');
$this->cache = new GKTemplateCache($this);
$this->cache->registerCache(); 
$this->cache->registerJSCompression();	 
*/
require('libs/detectmobilebrowser.php');
$params = JFactory::getApplication()->getTemplate(true)->params; 
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;


unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery-noconflict.js']);
unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery-migrate.min.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']);


$this->addFavicon($this->baseurl.'/images/favicon.ico');
/*$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.css');*/
$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.min.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/font-awesome.min.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/style.min.css');

$doc->addScript($this->baseurl.'/media/jui/js/jquery.min.js');
$doc->addScript('templates/'.$this->template.'/js/bootstrap.min.js');
$doc->addScript('templates/'.$this->template.'/js/main.min.js');

if(isset($doc->_scripts[$this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js']))
	{
	unset($doc->_scripts[$this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js']);
	$doc->addScript($this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js');
	} 
$doc->setGenerator('MHA');
?>
<!DOCTYPE html>

<html lang="<?php echo $this->language; ?>">

<head>
	<jdoc:include type="head" />	
</head>
<body class="contentpane">
	
		<jdoc:include type="message" />
		<jdoc:include type="component" />
	
</body>
</html>

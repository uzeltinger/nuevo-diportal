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
unset($doc->_scripts[$this->baseurl.'/media/jui/js/bootstrap.min.js']);
unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery-migrate.min.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']);
$this->addFavicon($this->baseurl.'/images/favicon.png');
/*$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.css');*/
$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.min.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/font-awesome.min.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/style.css');
$doc->addScript($this->baseurl.'/media/jui/js/jquery.min.js');
$doc->addScript($this->baseurl.'/media/jui/js/jquery-noconflict.js');
$doc->addScript($this->baseurl.'/media/jui/js/jquery-migrate.min.js');
$doc->addScript('templates/'.$this->template.'/js/bootstrap.min.js');
$doc->addScript('templates/'.$this->template.'/js/main.js');
if(isset($doc->_scripts[$this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js']))
	{
	unset($doc->_scripts[$this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js']);
	$doc->addScript($this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js');
    }
$this->addFavicon($this->baseurl.'/images/favicon.png');
$doc->addStyleSheet('templates/'.$this->template.'/css/bootstrap.min.css');
$doc->addStyleSheet('templates/'.$this->template.'/css/style.css');

//print_r($doc->_scripts);
/*
$doc->addScript($this->baseurl.'/media/jui/js/jquery.min.js');
$doc->addScript($this->baseurl.'/media/jui/js/jquery-noconflict.js');
$doc->addScript($this->baseurl.'/media/jui/js/jquery-migrate.min.js');  
$doc->addScript('templates/'.$this->template.'/js/bootstrap.min.js');
$doc->addScript('templates/'.$this->template.'/js/main.min.js');
*/

$doc->setGenerator('diportal');
if (JRequest::getInt('Itemid') == 101 )
{
    $doc->addCustomTag('<link rel="canonical" href="https://www.diportalpropiedades.com"/> ');
}
?><!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?php echo $this->baseurl.'/images/favicon.png'?>">
    <link rel="shortcut icon" href="<?php echo $this->baseurl.'/images/favicon.png'?>">
    <link rel="apple-touch-icon" href="<?php echo $this->baseurl.'/images/red-sos-favicon.png'?>">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700,900" rel="stylesheet">
	<jdoc:include type="head" />
    <link rel="stylesheet" href="<?php echo 'templates/'.$this->template.'/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo 'templates/'.$this->template.'/fonts/fontawesome/css/fontawesome-all.css'; ?>">
    <link rel="stylesheet" href="<?php echo 'templates/'.$this->template.'/css/style.css'; ?>">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    
<?php	/*
<script type="text/javascript">
jQuery(window).on('load',  function() {
	jQuery("#dimensions").html(jQuery( window ).width());
	});			
jQuery( window ).resize(function() {
	jQuery("#dimensions").html(jQuery( window ).width());
});
//	note	360	//	fame	320	//	core	320
</script>
*/?>
<!--[if lt IE 9]>
      <script src="<?php echo 'templates/'.$this->template.'/js/html5shiv.min.js'; ?>"></script>
      <script src="<?php echo 'templates/'.$this->template.'/js/respond.min.js'; ?>"></script>
<![endif]-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php
if(JRequest::getVar('option')!='com_properties')
{
$doc->addCustomTag('<meta property="og:type" content="website" /> ');
$doc->addCustomTag('<meta property="og:url" content="'.JURI::current().'" />');
$doc->addCustomTag('<meta property="og:title" content="mihogar propiedades." />');
$doc->addCustomTag('<meta property="og:image" content="http://propiedades.mihogar.net.ar/images/mihogar-logo-800.jpg" />');
$doc->addCustomTag('<meta property="og:description" content="Alquiler y Venta de Departamentos y Casas en Buenos Aires, Argentina." />');
}
?>

</head>
<?php if(!$detectmobilebrowser){$detectmobilebrowserBody='nomobilebrowserbody';}else{$detectmobilebrowserBody='mobilebrowserbody';}?>
<body class="<?php echo $detectmobilebrowserBody;?>">
 <?php if (JRequest::getInt('Itemid') == 101 ) : ?>
<?php endif; ?> 
<div id="dimensions" style="position:fixed; z-index:99999000; background-color:#fff;"></div>



   
    
    <header id="header" class="header">            
        <nav class="navbar navbar-expand-md navbar-light container-menu-all">
            <a class="navbar-brand" href="./">
                <img class="logo-superior" src="/images/logo.png" alt="diportal logo">
                <img class="logo-superior-min" src="/images/logo.png" alt="diportal logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <jdoc:include type="modules" name="navmenu" />
            </div>
        </nav>
    </header>

    <section class="topbar">
        <div class="topbar">
            <div class="topbar-inner">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6 col-md-4 d-none d-lg-block col-topbar">
                            <div class="icon icon-mapmarker">Buenos Aires</div>
                        </div>
                        <div class="col-6 col-sm-4 col-topbar">
                            <div class="icon icon-phone"><a href="tel:1130190242">11 3019-0242</a></div>
                        </div>                    
                        <div class="col-6 col-lg-4 col-topbar">                            
                            <div class="icon-facebook"><a target="_blank" href="https://www.facebook.com/diportal-Propiedades" alt="Facebook"><span>facebook</span></a> </div>
                        </div>

                    </div>                
                </div>
            </div>
        </div>
    </section>
    

    
<?php if ($this->countModules('topsearch')) : ?>
<div class="position_topsearch">
		<jdoc:include type="modules" name="topsearch" style="xhtml" />
</div>
<?php endif; ?>
<?php if ($this->countModules('topfeatured')) : ?>
<div class="position_topfeatured">
	<div class="container">
		<jdoc:include type="modules" name="topfeatured" style="xhtml" />
	</div>
</div>
<?php endif; ?>


<?php if (JRequest::getInt('Itemid') == 101 ) : ?>

<div style="padding: 2rem"></div>

    <section class="llamanos">
        <div class="llamanos">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="llamanos-text">
                            <p>Llamanos desde cualquer lugar del país para <br>pedir asesoramiento o solicitar un servicio.<br><strong>Tu consulta no molesta!</strong></p>
                        </div>                        
                    </div>
                    <div class="col-12 col-sm-12 col-md-6">
                        <div class="llamanos-phone">
                            <p>11 3019-0242</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   

<?php
endif; ?>
<?php if (JRequest::getInt('Itemid') == 101 ) : 
//require('mapa.php');
endif; ?>



<jdoc:include type="message" />
<div class="container main_container main_container-itemid-<?php echo JRequest::getInt('Itemid');?>">       
<?php if ($this->countModules('left')) { ?>
<div class="position_left">
	<div class="container">
		<jdoc:include type="modules" name="left" style="xhtml" />
	</div>
</div>
<?php } ?>
<?php 
		if ($this->countModules('left')) {
		$showLeft = true;
		}else{
		$showLeft = false;
		}
		if ($this->countModules('right')) {
		$showRight = true;
		}else{
		$showRight = false;
		}
		$contentClass = 'col-md-12';
		if($showRight)
			{
			$contentClass = 'col-xs-12 col-sm-12  col-md-8';
			}
		if($showLeft)
			{
			$contentClass = 'col-xs-12 col-sm-12  col-md-8';
			}	
?>
<?php if (JRequest::getInt('Itemid') == 101 ) : ?>
<?php else : ?>

<div class="row">
<div class="main_content <?php echo $contentClass;?>">
	<div class="position_component">	
			<jdoc:include type="component" />
 	</div>
</div>  
<?php endif; ?>
<?php if ($this->countModules('right')) { ?>
	<div class="sidebar sidebar-right col-xs-12 col-sm-12  col-md-4 ">
		<jdoc:include type="modules" name="right" style="xhtml" />
	</div>
<?php 	}?>
</div>    <!--	row	-->
</div>    <!--	container	-->    



<?php if ($this->countModules('bottom')) { ?>
	<div class="bottom">
		<jdoc:include type="modules" name="bottom" style="xhtml" />
	</div>
<?php 	}?>


<section class="footer">
    <div class="footer">






















    <div class="container-fluid footer-content">
            <div class="row">
            <!--
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-9">
                        <div class="menu-horizontal-expand-lg">
                    <div class="menu-horizontal menu-horizontal-collapse">
                        <ul class="menu-horizontal-nav">
                            <li class="menu-horizontal-item active">
                                <a class="menu-horizontal-link" href="#">INSTITUCIONAL</a>
                            </li>
                            <li class="menu-horizontal-item">
                                <a class="menu-horizontal-link" href="#">SERVICIOS</a>
                            </li>                    
                            <li class="menu-horizontal-item d-none d-md-block">
                                <a class="menu-horizontal-link" href="/contacto.html">CONTACTO</a>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>

                <div class="col col-xs-12 col-sm-12 d-md-none footer-menutres-mobile">
                    <div class="menu-horizontal-expand-lg">
                        <div class="menu-horizontal menu-horizontal-collapse">
                            <ul class="menu-horizontal-nav">
                                <li class="menu-horizontal-item">
                                    <a class="menu-horizontal-link" href="#">INFRAESTRUCTURA</a>
                                </li>                                
                                <li class="menu-horizontal-item d-none d-sm-block">
                                    <a class="menu-horizontal-link" href="/contacto.html">CONTACTO</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col col-xs-12 col-sm-12 d-sm-none footer-menutres-mobile">
                    <div class="menu-horizontal-expand-lg">
                        <div class="menu-horizontal menu-horizontal-collapse">
                            <ul class="menu-horizontal-nav">
                                <li class="menu-horizontal-item d-block d-sm-none">
                                    <a class="menu-horizontal-link" href="/contacto.html">CONTACTO</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

-->





                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 ml-auto">
                    
                </div>
                
            </div>
        </div>













        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
            		<div class="copyright">
                        <p>Mihogar propiedades - Buenos Aires - Argentina</p>
                        <p>Todos los derechos Reservados Mihogar SRL | Bahía Blanca</p>
                        
					</div>
                </div>                               
            </div>
        </div> 
    </div>
</section>    
<jdoc:include type="modules" name="sidebar" style="xhtml" />    
<jdoc:include type="modules" name="breadcrumbs" style="xhtml" />
<jdoc:include type="modules" name="footer" style="none" />
<?php require('analyticstracking.php');?>

<?php
/*
echo '<script src="templates/'.$this->template.'/js/jquery-3.2.1.slim.min.js"></script>';
echo '<script src="templates/'.$this->template.'/js/jquery-noconflict.js"></script>';
echo '<script src="templates/'.$this->template.'/js/popper.min.js"></script>';
echo '<script src="templates/'.$this->template.'/js/bootstrap.min.js"></script>';
echo '<script src="templates/'.$this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js"></script>';
if(isset($doc->_scripts[$this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js']))
	{
	unset($doc->_scripts[$this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js']);
	//$doc->addScript($this->baseurl.'/media/com_properties/prettyPhoto_compressed_316/js/jquery.prettyPhoto.js');
    
    } 
    
echo '<script src="templates/'.$this->template.'/js/main.js"></script>';
*/
?>

</body>
</html>
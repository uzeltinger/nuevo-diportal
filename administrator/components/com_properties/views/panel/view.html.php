<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

class PropertiesViewPanel extends JViewLegacy{
	
	function display($tpl = null)
	{	
	$canDo	= PropertiesHelper::getActions();	
		if (!$canDo->get('core.admin')) {
		$app =& JFactory::getApplication();
		$msg = JText::_('USER ERROR AUTHENTICATION FAILED').' : '. $this->Profile->name;
		$app->Redirect('index.php?option=com_properties&view=products', $msg);	
		}
	$doc = JFactory::getDocument();
	$app = JFactory::getApplication();
	$params		= JComponentHelper::getParams('com_properties');
	$expireDays=$params->get('expireDays',365);

	$this->products		= $this->get( 'Products' );
	$this->categories		= $this->get( 'Totalcategories' );
	$this->types			= $this->get( 'Totaltypes' );
	$this->morevisited	= $this->get( 'Morevisited' );

	$this->productpublished=0;
	$this->productunpublished=0;
	$this->producttotal=0;
	
	foreach($this->products as $p)
	{
	$this->producttotal++;	
		if($p->published==1)
		{
		$this->productpublished++;
		}else{
		$this->productunpublished++;
		}	
	}
	
	PropertiesHelper::addSubmenu('properties');
	$this->sidebar = JHtmlSidebar::render();		
		$this->addToolbar();
		parent::display( $tpl );		
	}		
	
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/helper.php';
		$canDo	= PropertiesHelper::getActions();		
		$text = JText::_( 'Control Panel' ) ;
		$icono = 'panel.png';
		JToolBarHelper::title(   JText::_( $text ), $icono);
		if ($canDo->get('core.admin')) {
			JToolBarHelper::divider();
			JToolBarHelper::preferences('com_properties');
		}		
	}
		
		
	function addIcon( $image , $view, $text )
	{
		$lang		=& JFactory::getLanguage();
		$link		= 'index.php?option=com_properties&view='.$view.'&limitstart=0&filter_order=ordering';
?>
		<div class="icon-wrapper" style="float:<?php echo ($lang->isRTL()) ? 'right' : 'left'; ?>;">
			<div class="icon">
				<a href="<?php echo $link; ?>">
                <img src="components/com_properties/includes/img/<?php echo $image; ?>" />
					
					<span><?php echo $text; ?></span></a>
			</div>
		</div>

<?php
	}	
	
	function getAgentName($aid)
		{		
		$db 	= JFactory::getDBO();	
		$query = $db->getQuery(true);		
		$query->select('pf.name');
		$query->from('#__properties_profiles AS pf');	
		$query->where('pf.mid = ' . (int) $aid);		
		$db->setQuery($query);		
		$data = $db->loadResult();	
		return $data;		
		}
	
}
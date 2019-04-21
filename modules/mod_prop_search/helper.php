<?php
/**
* @copyright	Copyright(C) 2008-2012 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;
require_once JPATH_SITE.'/components/com_properties/helpers/link.php';
jimport('joomla.application.component.model');

//JModel::addIncludePath(JPATH_SITE.'/components/com_properties/models');

abstract class modPropertiesSearchHelper
{


public static function getComboCategories(&$params, &$cParams)
	{
	$cid = Jrequest::getInt('c',0);
	$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();
		$query = 'SELECT c.id,c.name ';
		$query .= 'FROM #__properties_category as c ';
		$query .= 'WHERE c.published = 1 ORDER BY c.name';
		$db->setQuery($query);        
			$Categories = $db->loadObjectList();
		$citems 	= array();
			$citems[] 	= JHTML::_('select.option',  '0', JText::_( 'Cualquiera' ) );
			foreach ( $Categories as $citem ) 
				{
				$citems[] = JHTML::_('select.option',  $citem->id, $citem->name );
				}
			$javascript = '';		
			$ComboCategories = JHTML::_('select.genericlist',   $citems, 'c', 'class="form-control"'. $javascript, 'value', 'text', $cid );	
			
			return $ComboCategories;
	}





public static function getComboTypes(&$params, &$cParams)
	{
	$tid = Jrequest::getInt('t',0);
	$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();
		$query = 'SELECT ty.id,ty.name ';
		$query .= 'FROM #__properties_type as ty ';
		$query .= 'WHERE ty.published = 1 ORDER BY ty.name';
		$db->setQuery($query);        
			$Categories = $db->loadObjectList();
		$citems 	= array();
			$citems[] 	= JHTML::_('select.option',  '0', JText::_( 'Cualquiera' ) );
			foreach ( $Categories as $citem ) 
				{
				$citems[] = JHTML::_('select.option',  $citem->id, $citem->name );
				}
			$javascript = '';		
			$ComboTypes = JHTML::_('select.genericlist',   $citems, 't', 'class="form-control"'. $javascript, 'value', 'text', $tid );	
			
			return $ComboTypes;
	}
	
	









public static function getComboCapacity(&$params, &$cParams)
	{

$Md[0] = new JObject();
$Md[2] = new JObject();
$Md[3] = new JObject();
$Md[4] = new JObject();
$Md[5] = new JObject();
$Md[6] = new JObject();
$Md[7] = new JObject();
$Md[8] = new JObject();
$Md[9] = new JObject();
$Md[10] = new JObject();

$Md[0]->id_dormitorios='';
$Md[0]->dormitorios=JText::_('Cualquiera');
$Md[2]->id_dormitorios=2;
$Md[2]->dormitorios='2 '.JText::_('Persons');
$Md[3]->id_dormitorios=3;
$Md[3]->dormitorios='3 '.JText::_('Persons');
$Md[4]->id_dormitorios=4;
$Md[4]->dormitorios='4 '.JText::_('Persons');
$Md[5]->id_dormitorios=5;
$Md[5]->dormitorios='5 '.JText::_('Persons');
$Md[6]->id_dormitorios=6;
$Md[6]->dormitorios='6 '.JText::_('Persons');
$Md[7]->id_dormitorios=7;
$Md[7]->dormitorios='7 '.JText::_('Persons');
$Md[8]->id_dormitorios=8;
$Md[8]->dormitorios='8 '.JText::_('Persons');
$Md[9]->id_dormitorios=9;
$Md[9]->dormitorios='9 '.JText::_('Persons');
$Md[10]->id_dormitorios=10;
$Md[10]->dormitorios='10 '.JText::_('Persons or more');
	$javascript = '';

$comboBeds       = JHTML::_('select.genericlist',   $Md, 'p', 'class="form-control" '. $javascript,'id_dormitorios', 'dormitorios',  0); 

return $comboBeds;
	}
	

public static function getComboBeds(&$params, &$cParams)
	{

$Md[0] = new JObject();
$Md[1] = new JObject();
$Md[2] = new JObject();
$Md[3] = new JObject();
$Md[4] = new JObject();
$Md[5] = new JObject();

$Md[0]->id_dormitorios='';
$Md[0]->dormitorios=JText::_('Cualquiera');
$Md[1]->id_dormitorios=1;
$Md[1]->dormitorios='1 '.JText::_('Bedroom');
$Md[2]->id_dormitorios=2;
$Md[2]->dormitorios='2 '.JText::_('Bedrooms');
$Md[3]->id_dormitorios=3;
$Md[3]->dormitorios='3 '.JText::_('Bedrooms');
$Md[4]->id_dormitorios=4;
$Md[4]->dormitorios='4 '.JText::_('Bedrooms');
$Md[5]->id_dormitorios=5;
$Md[5]->dormitorios='5 '.JText::_('Bedrooms or more');
	
	$javascript = '';

$comboBeds       = JHTML::_('select.genericlist',   $Md, 'bd', 'class="form-control" '. $javascript,'id_dormitorios', 'dormitorios',  0); 

return $comboBeds;
	}
	
	public static function getComboBaths(&$params, &$cParams)
	{

$Md[0] = new JObject();
$Md[1] = new JObject();
$Md[2] = new JObject();
$Md[3] = new JObject();
$Md[4] = new JObject();
$Md[5] = new JObject();

$Md[0]->id_banios='';
$Md[0]->banios=JText::_('Baños');
$Md[1]->id_banios=1;
$Md[1]->banios='1 '.JText::_('Baño');
$Md[2]->id_banios=2;
$Md[2]->banios='2 '.JText::_('Baños');
$Md[3]->id_banios=3;
$Md[3]->banios='3 '.JText::_('Baños');
$Md[4]->id_banios=4;
$Md[4]->banios='4 '.JText::_('Baños');
$Md[5]->id_banios=5;
$Md[5]->banios='5 '.JText::_('Baños o más');
	
	$javascript = '';

$comboBeds       = JHTML::_('select.genericlist',   $Md, 'bt', 'class="form-control" '. $javascript,'id_banios', 'banios',  0); 

return $comboBeds;
	}




	public static function getComboStates(&$params, &$cParams)
	{
	$sid = Jrequest::getInt('s',0);
	$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();
		$query = 'SELECT c.id,c.name ';
		$query .= 'FROM #__properties_state as c ';
		$query .= 'WHERE c.published = 1 ORDER BY c.name';
		$db->setQuery($query);        
		$Categories = $db->loadObjectList();
		$citems 	= array();
			$citems[] 	= JHTML::_('select.option',  '0', JText::_( 'Cualquiera' ) );
			foreach ( $Categories as $citem ) 
				{
				$citems[] = JHTML::_('select.option',  $citem->id, $citem->name );
				}
			$javascript = '';		
			$ComboCategories = JHTML::_('select.genericlist',   $citems, 's', 'class="form-control select_state"'. $javascript, 'value', 'text', $sid );	
			
			return $ComboCategories;
	}

		
	public static function getListLocalities(&$params, &$cParams)
	{
	$lid = Jrequest::getInt('s',0);
	$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();

		$query = 'SELECT DISTINCT(p.lid), l.id, l.name, l.parent ';
		$query .= 'FROM #__properties_products as p ';
		$query .= 'LEFT JOIN #__properties_locality as l on l.id = p.lid ';
		$query .= 'WHERE p.published = 1 ORDER BY l.name';
		//echo nl2br(str_replace('#_','ou1ds',$query));
		/*$query = 'SELECT c.id, c.name, c.parent ';
		$query .= 'FROM #__properties_locality as c ';
		$query .= 'WHERE c.published = 1 ORDER BY c.name';*/
		$db->setQuery($query);        
		$localities = $db->loadObjectList();
		
			foreach ( $localities as $locality ) 
				{
				$citems[$locality->parent][] = $locality ;
				}
			//echo '<pre>';print_r($citems);
			return json_encode($citems);
			//return $citems;
	}
	
	public static function getList(&$params, &$cParams)
	{
		$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();
		$lang =& JFactory::getLanguage();
		$thisLang = $lang->getTag();
		$useTranslations=$cParams->get('useTranslations','0');
		
		$query = $db->getQuery(true);		
		$query->select('p.*');
		$query->from('#__properties_products AS p');
		$query->select('c.name as name_category,c.alias as alias_category');
		$query->join('LEFT', '#__properties_category AS c ON c.id = p.cid');		
		$query->select('t.name as name_type,t.alias as alias_type');
		$query->join('LEFT', '#__properties_type AS t ON t.id = p.type');		
		$query->select('cy.name as name_country,cy.alias as alias_country');
		$query->join('LEFT', '#__properties_country AS cy ON cy.id = p.cyid');		
		$query->select('s.name as name_state,s.alias as alias_state');
		$query->join('LEFT', '#__properties_state AS s ON s.id = p.sid');		
		$query->select('l.name as name_locality,l.alias as alias_locality');
		$query->join('LEFT', '#__properties_locality AS l ON l.id = p.lid');
		if($useTranslations)
			{
		$query->select('pt.published AS pt_published, pt.*');
		$query->join('LEFT', '#__properties_products_translations AS pt ON pt.pt_pid = p.id AND pt.pt_langcode ="'.$thisLang.'"');		
			}
		$query->where('p.published = 1');
		if($params->get('cid'))
			{
			$query->where('p.cid = ' . (int) $params->get('cid'));
			}				
		if (trim($params->get('ordering')) == 'rand()') {
		$query->order('rand() LIMIT '. $params->get('count', 10));		
		} else {
		$query->order($params->get('ordering', 'p.ordering').' '. $params->get('orderdir', 'ASC').' LIMIT '. $params->get('count', 10));	
		}
		
		$db->setQuery($query);		
		$items = $db->loadObjectList();		
		
		$rout_image = 'images/properties/images/thumbs';
		if($useTranslations)
		{
		require_once( JPATH_SITE.DS.'components'.DS.'com_properties'.DS.'helpers'.DS.'translation.php' );
		$items=translationHelper::getTranslationList($items,$thisLang);
		}
		
		foreach ($items as &$item) {		
			$item->imagename = modPropertiesSearchHelper::getItemImages($item->id);
			if($item->imagename)
				{
				$item->image = $rout_image.'/'.$item->id.'/'.$item->imagename->name;
				}else{
				$item->image =$rout_image.'/no-photo-available.jpg';
				}				
			$item->slug = $item->id.':'.$item->alias;	
			
			if($params->get('goToMenu'))
				{
				$item->link = LinkHelper::getProductLinkByMenu($params->get('goToMenu'), $item, $thisLang);	
				}else{
				switch($params->get('goToPropertyDetails','property'))
					{
					case 'category' :
					$item->link = LinkHelper::getLinkPropertyMenu('category', $item, $thisLang);
					break;
					case 'categoryprodduct' :
					$item->link = LinkHelper::getLinkPropertyMenuParent('category', $item, $thisLang);
					break;
					case 'property' :
					$item->link = LinkHelper::getProductLink('property', $item, $thisLang);
					break;			
					default :
					$item->link = LinkHelper::getProductLink('property', $item, $thisLang);	
					break;			
					}
				}
			$item->linkText = JText::_('MOD_ARTICLES_NEWS_READMORE');			
		}

		return $items;
	}
	
	public function &getItemImages($id = null,$limit=1)
	{		
		$db		= JFactory::getDbo();
		$query = $db->getQuery(true);		
		$query->select('i.*');
		$query->from('#__properties_images AS i');	
		$query->where('i.parent = ' . (int) $id);		
		$query->order('i.ordering ASC LIMIT '.$limit);		
		$db->setQuery($query);
		$data = $db->loadObject();	
		return $data;			
	} 
}

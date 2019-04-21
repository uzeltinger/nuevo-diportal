<?php
/**
* @copyright	Copyright(C) 2008-2012 Fabio Esteban Uzeltinger
* @license 		GNU/GPL http://www.gnu.org/copyleft/gpl.html
* @email		admin@com-property.com
**/
// no direct access
defined('_JEXEC') or die;
require_once JPATH_SITE.'/components/com_properties/helpers/link.php';

abstract class modPropListHelper
{
	public static function getList($params, $cParams)
	{
	
		$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();
		$lang = JFactory::getLanguage();
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
		$query->where('p.available < 2');
		if($params->get('cid'))
			{
			$query->where('p.cid = ' . (int) $params->get('cid'));
			}	
		if($params->get('featured'))
			{
			$query->where('p.featured = 1' );
			}				
		if (trim($params->get('ordering')) == 'rand()') {
		$query->order('rand() LIMIT '. $params->get('count', 10));		
		} else {
		$query->order($params->get('ordering', 'p.ordering').' '. $params->get('orderdir', 'ASC').' LIMIT '. $params->get('count', 10));	
		}
		
		
		
		$db->setQuery($query);		
		$items = $db->loadObjectList();	
		
		
		
		$rout_image = 'images/properties/images';
//	echo nl2br(str_replace('#_','jos',$query));require('a');		
		if($useTranslations)
		{
		require_once( JPATH_SITE.DS.'components'.DS.'com_properties'.DS.'helpers'.DS.'translation.php' );
		$items=translationHelper::getTranslationList($items,$thisLang);
		}
		/**/




		foreach ($items as $item) {	

		$imagePath = $rout_image.'/'.$item->id;		
		$item->imagename = modPropListHelper::getItemImages($item->id);

		if($item->imagename)
			{
				$item->image = $imagePath.'/'.$item->imagename->image;
			}else{
				$item->image =$rout_image.'/no-photo-available.jpg';
			}				
			
			$item->slug = $item->id.':'.$item->alias;
			$item->link = '';
			
			
			$LinkHelper = new LinkHelper();
			
			
			/*if($params->get('goToMenu'))
				{
				$item->link = LinkHelper::getProductLinkByMenu($params->get('goToMenu'), $item, $thisLang);	
				}else{*/

				switch($params->get('goToPropertyDetails','property'))
					{
					/*case 'category' :
					$item->link = LinkHelper::getLinkPropertyMenu('category', $item, $thisLang);
					break;*/
					case 'categoryprodduct' :
					$item->link = LinkHelper::getLinkPropertyMenuParent('category', $item, $thisLang);
					break;
					case 'property' :
					//$item->link = LinkHelper::getProductLink('property', $item, $thisLang);
					$item->link = $LinkHelper->getProductLink('property', $item, $thisLang);
					break;			
					default :
					$item->link = LinkHelper::getProductLink('property', $item, $thisLang);	
					break;			
					}

				//}
				
			$item->linkText = JText::_('MOD_PROP_LIST_READMORE');			
		}
		
		
		return $items;
	}
	
	public static function getItemImages($id = null,$limit=1)
	{		
		$db		= JFactory::getDbo();
		$query = $db->getQuery(true);		
		$query->select('i.*');
		$query->from('#__properties_images AS i');	
		$query->where('i.pro_id = ' . (int) $id);		
		$query->order('i.ordering ASC LIMIT '.$limit);		
		$db->setQuery($query);
		$data = $db->loadObject();	
		return $data;			
	} 
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public static function getAjax()
	{
	// Get module parameters
		jimport('joomla.application.module.helper');
		$input  = JFactory::getApplication()->input;
		$module = JModuleHelper::getModule('prop_list');
		$params = new JRegistry();
		$params->loadString($module->params);
		$calls  = 0;
		$mostradasInicial = 12;
		$startTo = 4;
		if ($input->get('calls')) 
			{
			$calls  = $input->get('calls');
			}
			/*
		$startFrom = $calls * (int) $params->get('count', 4);
		$startTo = (int) $params->get('count', 0);
			*/
			
			
			
			
			
			
			
			
			
			
			
			
			
			if (isset($_SERVER)) { if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
{ $ip = $_SERVER["HTTP_X_FORWARDED_FOR"]; }
elseif(isset($_SERVER["HTTP_CLIENT_IP"]))
{ $ip = $_SERVER["HTTP_CLIENT_IP"]; }
else { $ip = $_SERVER["REMOTE_ADDR"]; }
}
else { if ( getenv( 'HTTP_X_FORWARDED_FOR' ) )
{ $ip = getenv( 'HTTP_X_FORWARDED_FOR' ); }
elseif ( getenv( 'HTTP_CLIENT_IP' ) )
{ $ip = getenv( 'HTTP_CLIENT_IP' ); }
else { $ip = getenv( 'REMOTE_ADDR' ); }
}

		$db		= JFactory::getDbo();	
		$datenow = JFactory::getDate();
		$fechaActual = $datenow->toSql();		
		$d = new DateTime($fechaActual);
		$d->modify('-3 hours');
		$dateNow = $d->format('Y-m-d');			
		$timeNow = $d->format('H:i:s');		
		$userIP = $ip;				
		$query = 'INSERT INTO  #__properties_scrolls VALUES ("","'.(int) $calls.'","'.$dateNow.'","'.$timeNow.'","'.$userIP.'")';
		//echo $query;
		$db->setQuery( $query );
		/*
		if (!$db->query())
		{
			JError::raiseError(500, $db->getErrorMsg() );
		}	
*/
	
	
	
	
		
		
		$startMultiplica = 	$calls - 1;
		$startFrom = ($startMultiplica * 4) + $mostradasInicial;
			/*
		if($calls == 1)
		{
		$startFrom = $mostradasInicial;		
		}else{
		$startFrom = ($calls * 4) + $mostradasInicial;		
		}
		*/
		
		
			
		$app	= JFactory::getApplication();
		$db		= JFactory::getDbo();
		
		
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
		
			
		$query->where('p.published = 1');
		$query->where('p.available < 2');
		if($params->get('cid'))
			{
			$query->where('p.cid = ' . (int) $params->get('cid'));
			}	
		if($params->get('featured'))
			{
			$query->where('p.featured = 1' );
			}				
		if (trim($params->get('ordering')) == 'rand()') {
		$query->order('rand() LIMIT '. $startTo);		
		} else {
		$query->order($params->get('ordering', 'p.ordering').' '. $params->get('orderdir', 'ASC').' LIMIT '. $startFrom.', '.$startTo);	
		}
		
		
		
		$db->setQuery($query);		
		$items = $db->loadObjectList();	
		
		$thisLang = null;
		
		$rout_image = 'images/properties/images';
//	echo nl2br(str_replace('#_','jos',$query));require('a');		
		
		/**/
		foreach ($items as $item) {		
			$item->imagename = modPropListHelper::getItemImages($item->id);
			if($item->imagename)
				{
				$item->image = $rout_image.'/'.$item->id.'/'.$item->imagename->name;
				}else{
				$item->image =$rout_image.'/no-photo-available.jpg';
				}				
			$item->slug = $item->id.':'.$item->alias;
			$item->link = '';
			
			
			$LinkHelper = new LinkHelper();
			
			
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
					//$item->link = LinkHelper::getProductLink('property', $item, $thisLang);
					$item->link = $LinkHelper->getProductLink('property', $item, $thisLang);
					break;			
					default :
					$item->link = LinkHelper::getProductLink('property', $item, $thisLang);	
					break;			
					}
				}
				
			$item->linkText = JText::_('MOD_PROP_LIST_READMORE');			
		}
		
		
		
$list = $items;
	
	$x=0;
$devolver = '';
for ($i = 0, $n = count($list); $i < $n; $i ++) :
$item = $list[$i];
$pares=false;$trios=false;$cuartetos=false;
$paresClass = '';
if($x>0)
	{
if($x%2==0){$pares=true;}
if($x%3==0){$trios=true;}
if($x%4==0){$cuartetos=true;}
if($pares){$paresClass = ' paresclass';}else{$paresClass = '';}
if($trios){$paresClass.= ' triosclass';}
if($cuartetos){$paresClass.= ' cuartetosclass';}
	}
$x++;
$devolver .= '
<div title="'.str_replace('"',' ',$item->name).'" class="col-ss-12 col-xs-6 col-sm-6 col-md-3 col-lg-3'.$paresClass.'">
';
$devolver .= '<div class="panel panel-default pan-property">';
$devolver .= '<div class="thumbnails thumbnail-style thumbnail-kenburn">';
$devolver .= '<a href="'.$item->link.'" title="'.str_replace('"',' ',$item->name).'">';
$devolver .= '<div class="thumbnail-img">';
$devolver .= '<div class="overflow-hidden">';
$devolver .= '<div class="imagenfondo" style="background-image: url(\''.$item->image.'\');">&nbsp;</div>';
$devolver .= '</div>';
$devolver .= '</div>';
$devolver .= '</a>';
$devolver .= '</div>';
$devolver .= '<div class="panel-body">';
$devolver .= '<h4>';
$devolver .= '<a class="titlelink" href="'.$item->link.'" title="'.str_replace('"',' ',$item->name).'">'. str_replace('"',' ',$item->name).'</a>';
$devolver .= '</h4>';
$devolver .= '</div>';
$devolver .= '		<div class="list-group">';
$devolver .= '			<span class="list-group-item type_category"><h3>'.$item->name_type.' '.$item->name_category.'&nbsp;</h3></span>';
$devolver .= '			<span class="list-group-item overflow-hiden">'.$item->address.'</span>';
$devolver .= '			<span class="list-group-item">'.$item->capacity.' '.($item->capacity == 1 ? JText::_('Persona') : JText::_('Personas')).'<span class="pull-right">'.$item->bedrooms.' '.($item->bedrooms == 1 ? JText::_('Dormitorio') : JText::_('Dormitorios')).'</span></span>';
$devolver .= '		</div>';
$devolver .= '
		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<p>
                    <button type="button" class="btn btn-info btn-md btn-block btn-contactar" data-toggle="modal" data-target="#myContactModal" data-id="'.str_replace('"',' ',$item->id).'" data-name="'. str_replace('"',' ',$item->name).'">Contactar</button>                    
                    </p>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<p><a class="btn btn-md btn-success btn-block" href="'.$item->link.'" title="">'. JText::_('Detalles').'</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
';
endfor; 



	
	return $devolver;
	exit();
	
	
	
	
		
		
		}
		
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	





	

	
	
	
	
	
	
	
	
}

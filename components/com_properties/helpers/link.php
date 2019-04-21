<?php
/**
 * @version		$Id: properties.php 1 2006-2016 este8an $
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2008 - 2016 Fabio Esteban Uzeltinger.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die('Restricted access'); 
class LinkHelper
{	
	public static function getItemid( $TableName,$lang=NULL )
	{
		$and=' AND published = 1';
		if($lang)
			{
			$and=' AND (language = "'.$lang.'" OR language = "*")';
			}
		$db = JFactory::getDBO();	
		$query = 'SELECT id FROM #__menu' .
				' WHERE link = "index.php?option=com_properties&view='.$TableName.'"'.$and;					
		$db->setQuery( $query );
		$output = $db->loadResult();
		/**/
		if(!$output){
		$query = 'SELECT id FROM #__menu' .
				' WHERE link LIKE "%index.php?option=com_properties&view=properties%"'.$and;			
		$db->setQuery( $query );
		$output = $db->loadResult();
		}		
		
		return $output;
	}	

public static function getProductLink( $Pview, $product, $lang=NULL, $langSef=null )
	{
	$params		= JComponentHelper::getParams('com_properties');
	$urlRefId = $params->get('urlRefId',0);
	
	$l = 'index.php?option=com_properties&view='.$Pview;
	$d='';
	$data=null;
	if($useDataInUrl = $params->get('useDataInUrl'))
	{
	if($urlCountry=$params->get('urlCountry') & isset($product->alias_country))
		{
		$data[]=$product->alias_country;
		}
	if($urlState=$params->get('urlState') & isset($product->alias_state))
		{
		$data[]=$product->alias_state;
		}	
	if($urlLocality=$params->get('urlLocality') & isset($product->alias_locality))
		{
		$data[]=$product->alias_locality;
		}	
	if($urlType=$params->get('urlType') & isset($product->alias_type))
		{
		$data[]=$product->alias_type;
		}	
	if($urlCategory=$params->get('urlCategory') & isset($product->alias_category))
		{
		$data[]=$product->alias_category;
		}
	}	
	$config	= new JConfig();
		
	if($config->sef)
		{
		if($data)
			{
			$d = implode('_',$data);
			$l.='&data='.$d;			
			}
		
		switch($urlRefId)
			{
			case 0 :
			$l.='&id='.$product->id;
			break;
			case 1 :
			$l.='&id='.$product->id;
			break;
			case 2 :
			$l.='&id='.$product->ref;
			break;		
			case 3 :
			$l.='&id='.$product->id.'-'.$product->alias;
			break;
			case 4 :
			$l.='&id='.$product->ref.'-'.$product->alias_type.'-'.$product->alias_category.'-'.$product->alias;
			break;	
			case 5 :
			$l.='&id='.$product->alias;
			break;	
			default :
			$l.='&id='.$product->id;
			break;
			}	
			$l.='&Itemid='.LinkHelper::getItemid($Pview,$lang);	
			$link = JRoute::_($l);
				
		
		}else{
			if($Pview=='properties')
				{
				$l.='&id='.$product->id;
				}elseif($Pview=='property'){
				$l.='&id='.$product->id;
				}
			$l.='&Itemid='.LinkHelper::getItemid($Pview,$lang);	
			$link = $l;
		}	
		//echo $l;
			
	$l.='&Itemid='.LinkHelper::getItemid($Pview,$lang);	
	$link = JRoute::_($l);		
	return $link;
	}

}
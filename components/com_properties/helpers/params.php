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
$params		= JComponentHelper::getParams('com_properties');
	
$currencyformat=$params->get('FormatPrice');
$loadBootstrapCss=$params->get('loadBootstrapCss',1);
$UseCountry = $params->get('UseCountry');
$UseCountryDefault = $params->get('UseCountryDefault');
$UseState = $params->get('UseState');
$UseStateDefault = $params->get('UseStateDefault');
$UseLocality = $params->get('UseLocality');
$UseLocalityDefault = $params->get('UseLocalityDefault');
$PropertiesShow = $params->get('PropertiesShow');
$AutoCoord = $params->get('AutoCoord');
$ActiveMap = $params->get('ActiveMap',1);
$MapApiKey = $params->get('MapApiKey');
$MapDistance = $params->get('MapDistance');
$DefaultLat = $params->get('DefaultLat');
$DefaultLng = $params->get('DefaultLng');
$ShowOrderByDefault = $params->get('ShowOrderByDefault');
$ShowOrderDefault = $params->get('ShowOrderDefault');
$SimbolPrice = $params->get('SimbolPrice');
$PositionPrice = $params->get('PositionPrice');
$FormatPrice = $params->get('FormatPrice');
$Listlayout = $params->get('Listlayout');

$ShowReferenceInList = $params->get('ShowReferenceInList');
$ShowCountryInList = $params->get('ShowCountryInList');
$ShowStateInList = $params->get('ShowStateInList');
$ShowLocalityInList = $params->get('ShowLocalityInList');
$ShowCategoryInList = $params->get('ShowCategoryInList');
$ShowTypeInList = $params->get('ShowTypeInList');
$ShowAddressInList = $params->get('ShowAddressInList');
$ShowPriceInList = $params->get('ShowPriceInList');
$ShowYearsInList = $params->get('ShowYearsInList');
$ShowBedroomsInList = $params->get('ShowBedroomsInList');
$ShowBathroomsInList = $params->get('ShowBathroomsInList');
$ShowGarageInList = $params->get('ShowGarageInList');
$ShowTotalAreaInList = $params->get('ShowTotalAreaInList');
$ShowCoveredAreaInList = $params->get('ShowCoveredAreaInList');
$ShowDetailsMarketInList = $params->get('ShowDetailsMarketInList');
$ShowContactLink = $params->get('ShowContactLink');
$ShowMapLink = $params->get('ShowMapLink');

$DetailLayout = $params->get('DetailLayout','defaul');
$ShowImagesSystemDetail = $params->get('ShowImagesSystemDetail');
$pretty_photo_style = $params->get('pretty_photo_style');
$ShowCapacityInDetail  = $params->get('ShowCapacityInDetail',1);
$ShowMapInDetail = $params->get('ShowMapInDetail',1);
$ShowReferenceInDetail = $params->get('ShowReferenceInDetail',1);
$ShowCountryInDetail = $params->get('ShowCountryInDetail',1);
$ShowStateInDetail = $params->get('ShowStateInDetail',1);
$ShowLocalityInDetail = $params->get('ShowLocalityInDetail',1);
$ShowCategoryInDetail = $params->get('ShowCategoryInDetail',1);
$ShowTypeInDetail = $params->get('ShowTypeInDetail',1);
$ShowAddressInDetail = $params->get('ShowAddressInDetail',1);
$ShowPriceInDetail = $params->get('ShowPriceInDetail',1);
$ShowRoomsInDetail = $params->get('ShowRoomsInDetail',1);
 
$ShowYearsInDetail = $params->get('ShowYearsInDetail');
$ShowBedroomsInDetail = $params->get('ShowBedroomsInDetail');
$ShowBathroomsInDetail = $params->get('ShowBathroomsInDetail');
$ShowGarageInDetail = $params->get('ShowGarageInDetail');
$ShowTotalAreaInDetail = $params->get('ShowTotalAreaInDetail');
$ShowCoveredAreaInDetail = $params->get('ShowCoveredAreaInDetail');
$ShowDetailsMarketInDetail = $params->get('ShowDetailsMarketInDetail');
$ShowContactInfoDetail = $params->get('ShowContactInfoDetail',1);
$ShowContactFormDetail = $params->get('ShowContactFormDetail',1);
$ShowContactLinkDetail = $params->get('ShowContactLinkDetail');

?>		
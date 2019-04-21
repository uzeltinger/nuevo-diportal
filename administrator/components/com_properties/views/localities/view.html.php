<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view' );

class PropertiesViewLocalities extends JViewLegacy
	{
	protected $items;
	protected $pagination;
	protected $state;
	
	
	public function display($tpl = null)
	{
		if ($this->getLayout() !== 'modal')
		{
			PropertiesHelper::addSubmenu('localities');
		}
		
		$canDo	= PropertiesHelper::getActions();		
		if (!$canDo->get('core.admin')) {
		$app =& JFactory::getApplication();
		$msg = JText::_('USER ERROR AUTHENTICATION FAILED').' : '. $this->Profile->name;
		$app->Redirect(JRoute::_('index.php?option=com_properties', $msg));	
		}
		
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');
		$this->filterForm    = $this->get('FilterForm');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JFactory::getApplication()->enqueueMessage(implode("\n", $errors), 'error');
			return false;
		}		

		if ($this->getLayout() !== 'modal')
		{
			$this->addToolbar();
			$this->sidebar = JHtmlSidebar::render();	
		}

		parent::display($tpl);

		//$this->companyUpdateLocalities();
	}
		
		
	
		
	
	protected function addToolbar()
	{
		$state	= $this->get('State');		
		JToolBarHelper::title(JText::_('COM_PROPERTIES_MANAGER_LOCALITIES'), 'localities.png');
			JToolBarHelper::custom('locality.add', 'new.png', 'new_f2.png','JTOOLBAR_NEW', false);
		
			JToolBarHelper::custom('locality.edit', 'edit.png', 'edit_f2.png','JTOOLBAR_EDIT', true);		
		
			JToolBarHelper::divider();
			
			JToolBarHelper::custom('localities.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			JToolBarHelper::custom('localities.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
			
			JToolBarHelper::divider();
			JToolBarHelper::deleteList('', 'localities.delete','JTOOLBAR_REMOVE');
			
		
	}
		
	protected function getSortFields()
	{
		return array(
			'a.ordering'     => JText::_('JGRID_HEADING_ORDERING'),
			'a.published'        => JText::_('JSTATUS'),
			'a.name'        => JText::_('JGLOBAL_TITLE'),
			'a.id'           => JText::_('JGRID_HEADING_ID')
		);
	}



	function addLocalities(){
		$json = 'http://diportal.com.ar/index.php?option=com_osproperty&task=json_cities';
	}



	static function companyUpdateLocalities()
	{
		global $mainframe;
		$db = JFactory::getDbo();

		$jsonDataString = file_get_contents('http://diportal.com.ar/index.php?option=com_osproperty&task=json_cities');
		$jsonData = json_decode($jsonDataString,true);

		$citiesValue = '';
		$mlCitiesValue = '';
		$c=0;
		foreach ($jsonData as $city) {
			$c++;
			$cities[$city['city_id']]=$city['city_name'];
			$states[$city['state_id']]['state_name']=$city['state_name'];
			$states[$city['state_id']]['state_parent']=$city['state_parent'];
			$states[$city['state_id']]['state_code']=$city['state_code'];
			$states[$city['state_id']]['state_published']=$city['state_published'];
			$countries[$city['country_id']]['country_name']=$city['country_name'];
			$countries[$city['country_id']]['country_code']=$city['country_code'];
			$citiesValue .= "('".$city['city_id']."', '".$city['city_name']."', '".$city['state_id']."', '1')";
			if($c<count($jsonData)){$citiesValue .=",";}

			$mlCitiesValue .= "('".$city['city_id']."', '".$city['city_name']."', '".$city['mlcityid']."', '".$city['mlneighborhoodid']."')";
			if($c<count($jsonData)){$mlCitiesValue .=",";}
		}

		$s=0;
		foreach ($states as $key => $value) {
			$s++;
			$state_country_id = $value['state_parent'];
			$state_name = $value['state_name'];
			$state_code = $value['state_code'];
			$state_published = $value['state_published'];

			$statesValue .= "('$key', '$state_name', '$state_country_id', '$state_published')";
			if($s<count($states)){$statesValue .=",";}
		}

		$cy=0;
		foreach ($countries as $key => $value) {
			$cy++;
			$country_name = $value['country_name'];
			$countriesValue .= "('$key', '$country_name')";
			if($cy<count($countries)){$countriesValue .=",";}
		}
		print_r($countries);
//require('0');ou1ds_properties_locality
		$db->setQuery("DELETE FROM #__properties_locality");
		$db->query();		

		$queryCities = "";
		$queryCities .= "INSERT INTO #__properties_locality (`id`, `name`, `parent`, `published`) VALUES ";
		$queryCities .= $citiesValue.";";
		$db->setQuery($queryCities);
		$db->query();

		$db->setQuery("DELETE FROM #__properties_state");
		$db->query();		
		$queryStates = "";
		$queryStates .= "INSERT INTO #__properties_state (`id`, `name`, `parent`, `published`) VALUES ";
		$queryStates .= $statesValue.";";
		$db->setQuery($queryStates);
		$db->query();

		$db->setQuery("DELETE FROM #__properties_country");
		$db->query();		
		$queryCountries = "";
		$queryCountries .= "INSERT INTO #__properties_country (`id`, `name`) VALUES ";
		$queryCountries .= $countriesValue.";";
		$db->setQuery($queryCountries);
		$db->query();
/*
		$db->setQuery("DELETE FROM #__osrs_ml_cities");
		$db->query();		

		$queryMlCities = "";
		$queryMlCities .= "INSERT INTO #__osrs_ml_cities (`id`, `city`, `mlcityid`, `mlneighborhoodid`) VALUES ";
		$queryMlCities .= $mlCitiesValue.";";
		$db->setQuery($queryMlCities);
		$db->query();*/
//echo $queryMlCities; die();
		$msg = 'Localidades Actualizadas';
		//$mainframe->redirect(JRoute::_('index.php?option=com_osproperty&task=company_properties'),$msg);
	}


	
}
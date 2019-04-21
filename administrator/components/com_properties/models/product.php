<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

class PropertiesModelProduct extends JModelAdmin
{	
	
	public function getTable($type = 'Products', $prefix = 'PropertiesTable', $config = array())
	{
	$t=JTable::getInstance($type, $prefix, $config);
		return JTable::getInstance($type, $prefix, $config);
	}
	
	public function getForm($data = array(), $loadData = true)
	{
		jimport('joomla.form.form');
		JForm::addFieldPath('JPATH_ADMINISTRATOR/components/com_properties/models/fields');

		$form = $this->loadForm('com_properties.product', 'product', array('control' => 'jform', 'load_data' => $loadData));
		if (empty($form)) {
			return false;
		}
		return $form;
	}	
	

	protected function loadFormData() 
	{
		$data = JFactory::getApplication()->getUserState('com_properties.edit.product.data', array());
		if (empty($data)) {
			$data = $this->getItem();
			$agent = $this->getProfile();
			if($agent && $agent->mid){
				$data->set('agent_id',$agent->mid);				
			}
		}
		return $data;
	}		
		
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');
		
		$user = JFactory::getUser();
		$params		= JComponentHelper::getParams('com_properties');
		$AutoCoord=$params->get('AutoCoord',0);	
		$apikey=$params->get('MapApiKey',0);
		
		
		//print_r($table);require('a');

		$table->name		= htmlspecialchars_decode($table->name, ENT_QUOTES);
		$table->alias		= JApplication::stringURLSafe($table->alias);

		if (empty($table->alias)) {
			$table->alias = JApplication::stringURLSafe($table->name);
		}

		if (empty($table->id)) {
			// Set the values
			//$table->created	= $date->toMySQL();
			// Set ordering to the last item if not set
			if (empty($table->ordering)) {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__properties_products');
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}
			
		}else{		
		/*
		if($AutoCoord){
			if(!$table->lat){
				$coord=$this->getCoord();
				$ll=explode(',',$coord);
				if($ll[0]!=0){$table->lat=$ll[0];}
				if($ll[1]!=0){$table->lng=$ll[1];}
			}
		}
		*/
		//print_r($table);require('a');
			// Set the values
			//$table->modified	= $date->toMySQL();
			//$table->modified_by	= $user->get('id');
		}
	}	
	
	protected function getReorderConditions($table = null)
	{
		//$condition = array();
		//$condition[] = 'catid = '.(int) $table->catid;
		//return $condition;
	}
		
	
	protected function canEditState($record)
	{
	$user = JFactory::getUser();
	$userId		= $user->get('id');	
		
	if ($user->authorise('core.admin', 'com_properties')) {
	$allow = true;
	}else{
	
	$manageProduct = $user->authorise('core.manage.product', 'com_properties');				
		
	if($manageProduct)
		{		
	$Profile = $this->getProfile();		
	$agentId = $record->agent_id;		
	if($Profile->id != $agentId){ $allow = false;}else{$allow = true;}
		}	
		
	}	
		return $allow;
	}
	
	
	protected function canDelete($record)
	{
	$user = JFactory::getUser();
	$userId		= $user->get('id');	
	if ($user->authorise('core.admin', 'com_properties')) {
	$allow = true;
	}else{
	
	$allow = $user->authorise('core.manage.product', 'com_properties');	
	if($allow)
		{		
	$Profile = $this->getProfile();		
	$agentId = $record->agent_id;		
	if($Profile->id != $agentId){ $allow = false;}
		}	
	}	
		return $allow;
	}
	
	
	
	
	public function save($data)
	{
	$jinput = JFactory::getApplication()->input;
	$params		= JComponentHelper::getParams('com_properties');
		$AutoCoord=$params->get('AutoCoord',0);	
		$apikey=$params->get('MapApiKey',0);
		$DefaultLat=$params->get('DefaultLat',0);
		$DefaultLng=$params->get('DefaultLng',0);
		

		if(isset($data['lat']) & $data['lat']<=0)
		{
			if($data['lat']==0)
			{
				if($AutoCoord)
				{			
				$coord=$this->getCoord($data);
				$ll=explode(',',$coord);
				if($ll[0]!='0.000000'){$data['lat']=$ll[0];}
				if($ll[1]!='0.000000'){$data['lng']=$ll[1];}			
				}
			}
		}else{
		$data['lat']=$DefaultLat;
		$data['lng']=$DefaultLng;
		}
		
		if (parent::save($data)) {
		
			$this->ChangeImageOrder();	
			
			$deleteimage	= $jinput->get('deleteimage',  array(), 'post', 'array');
			
			
			
			
			if($deleteimage)
			{	
			$this->deleteImages();	
			}
			return true;
		}

		return false;
	}
	
	
	public function delete(&$data)
	{	
	if (parent::delete($data)) 
		{	
		foreach($data as $pid)
			{				
			$existe = $this->getProduct($pid);		
			if(!$existe)
				{
				$this->deleteProductImages($pid);	
				$this->deleteProductTranslations($pid);
				}			
			}	
		}		
		return true;
	}
	
	public function deleteProductImages($pid)
	{
	jimport('joomla.filesystem.folder');
	jimport('joomla.filesystem.file');	
	$db 	=& JFactory::getDBO();
	
	//echo '<br>'.'<b>'.$pid.'</b><br>';	
	
	$photo = JPATH_SITE."/images/properties/images/".$pid;	
	$thumb = JPATH_SITE."/images/properties/images/thumbs/".$pid;
		
		$query = 'DELETE FROM #__properties_images' .
				' WHERE parent = '.$pid;
								
			$db->setQuery( $query );
			//echo '<br>'.$query;
			
			if (!$db->query())
				{
				
				JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
				}	
			
			
			if (JFolder::exists($photo))
        		{
           		JFolder::delete($photo);
				//echo '<br>'.$photo;
       			}
			if (JFolder::exists($thumb))
        		{
            	JFolder::delete($thumb);
				//echo '<br>'.$thumb;
       			}			
		
	}
	
	public function deleteProductTranslations($pid)
	{	
	$db 	=& JFactory::getDBO();	
		
		$query = 'DELETE FROM #__properties_products_translations' .
				' WHERE pt_pid = '.$pid;								
			$db->setQuery( $query );			
			if (!$db->query())
				{
				JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
				}		
	}
	
	public function deleteImages()
	{
	jimport('joomla.filesystem.folder');
	jimport('joomla.filesystem.file');	
	$db 	= JFactory::getDBO();
	$jinput = JFactory::getApplication()->input;
	$data	= $jinput->get('jform', array(), 'post', 'array');
	$id	= $data['id'];	
	$deleteimage	= $jinput->get( 'deleteimage', array(), 'post', 'array');
	
	if($deleteimage)
		{	
		$photo = JPATH_SITE."/images/properties/images/".$id."/";	
		$thumb = JPATH_SITE."/images/properties/images/thumbs/".$id."/";	

		foreach($deleteimage as $image_name=>$valor)
			{		
			$query = 'DELETE FROM #__properties_images' .
				' WHERE name = \''.$image_name.'\'';				
			$db->setQuery( $query );
			if (!$db->query())
				{
				JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
				}						
			if (JFile::exists($photo.$image_name))
        		{
           		JFile::delete($photo.$image_name);
       			}
			if (JFile::exists($thumb.$image_name))
        		{
            	JFile::delete($thumb.$image_name);
       			 }			
			}   
		}	
	}
	
	
	
	public function ChangeImageOrder()
	{
	$jinput = JFactory::getApplication()->input;
	$data	= $jinput->get('jform', array(), 'post', 'array');
	$array	= $jinput->get('myOrden', array(), 'post', 'array');

	$db 	= JFactory::getDBO();
	
		$myOrden=explode(',',$array);		

		for($x=0;$x<count($myOrden);$x++)
			{
			$image_id=explode('_',$myOrden[$x]);
			$CambiarOrden[$image_id[0]]=$x;
			//echo $myOrden[$x];
			
			$query = 'UPDATE #__properties_images'
			. ' SET ordering = \'' . (int) ($x+1)
			. '\' WHERE id = '. (int) $image_id[0]
			;	
		
			$db->setQuery( $query );
				if (!$db->query())
				{
				JFactory::getApplication()->enqueueMessage($db->getErrorMsg(), 'error');
				}
				
			}	

}
	
	public function getProfile()
		{
		$db 	= JFactory::getDBO(); 
		$user = JFactory::getUser();	
	$query = 'SELECT * FROM #__properties_profiles WHERE mid = '.$user->get('id');		
        $db->setQuery($query);        
		$profile = $db->loadObject();		
		return $profile;
		}
		
		
	
	public function getAgentProducts($aid,$published=null)
		{
		$db 	=& JFactory::getDBO(); 	
	$query = 'SELECT id,published FROM #__properties_products WHERE agent_id = '.$aid;	
	if($published){$query .=' AND published = 1';}	
        $db->setQuery($query);        
		$Products = $db->loadObjectList();		
		return $Products;
		}
	
	
	
	
	
	function getProduct($id) 
  {   
  $db 	=& JFactory::getDBO();
 	$query = 'SELECT id FROM #__properties_products WHERE id = '.$id;		
		$db->setQuery($query);      
		$Product = $db->loadResult();
		return $Product;
  }
  	
		/*
	public function gettype_js()
		{
		$db 	= JFactory::getDBO(); 
		$return_js ='';
	
	$query = 'SELECT * FROM #__properties_category WHERE published = 1 ORDER BY name';		
        $db->setQuery($query);        
		$Categories = $db->loadObjectList();
		
	$query = 'SELECT * FROM #__properties_type WHERE published = 1 ORDER BY name';	
		$db->setQuery($query);  
		$Types = $db->loadObjectList();
		$x=0;
		$TypesParent= array();
		
		foreach($Types as $tc)
				{
				$TypesParent[$tc->parent][$tc->id]->parent=$tc->parent;
				$TypesParent[$tc->parent][$tc->id]->id=$tc->id;
				$TypesParent[$tc->parent][$tc->id]->name=$tc->name;
				$x++;
				}
		

		$CatTypes = array();
		
		foreach($Categories as $cat)
			{
			if(isset($TypesParent[$cat->id]))
				{
				foreach($TypesParent[$cat->id] as $tc)
					{
					$CatTypes[$cat->id][$tc->id]->parent=$tc->parent;
					$CatTypes[$cat->id][$tc->id]->id=$tc->id;
					$CatTypes[$cat->id][$tc->id]->name=$tc->name;
					$CatTypes[$cat->id][$tc->id]->catid=$cat->id;
					}	
				}				
			if($TypesParent[0])
				{
				foreach($TypesParent[0] as $tc)
					{
					$CatTypes[$cat->id][$tc->id]->parent=$tc->parent;
					$CatTypes[$cat->id][$tc->id]->id=$tc->id;
					$CatTypes[$cat->id][$tc->id]->name=$tc->name;
					$CatTypes[$cat->id][$tc->id]->catid=$cat->id;
					}	
				}
			}


		if($CatTypes){	
				$x=0;
				$tmp_parent=0;
				$return_js='';
				//$return_js.="types[$x] = new Array( '0','0','".JText::_( 'All Types' )."' );"."\n";	
					
					foreach ( $CatTypes as $catitem ) {

			foreach ( $catitem as $sitem ) {
			
						if($tmp_parent!=$sitem->catid)
							{
							$tmp_parent=$sitem->catid;
					//$return_js.="types[$x] = new Array( '".$sitem->catid."','0','".JText::_( 'All Types' )."' );"."\n";									
					
					$x++;			
							}						
		$return_js.="types[$x] = new Array( '".$sitem->catid."','".$sitem->id."','".JText::_($sitem->name)."' );\n";		
		$x++;
					}
					
				}
			}

return $return_js;	
		
		}
		
		*/
		
		
		
		
		
		
		
		
		
		
		
	function getStates_js()
    { 
	$db 	= JFactory::getDBO();     
		$return_js ='';
	

			$query = 'SELECT * FROM #__properties_state WHERE published = 1 ORDER BY parent,name';
		
			
			$db->setQuery($query);        
			$States = $db->loadObjectList();
		
			
				if($States){	
				$x=1;
				$tmp_parent=0;
				$return_js='';
				//$return_js.="states[0] = new Array( '1','0',' -= Seleccionar =- ' );"."\n";	
				
			
					foreach ( $States as $sitem ) {
					
						if($tmp_parent!=$sitem->parent)
							{
							$tmp_parent=$sitem->parent;
					$return_js.="states[$x] = new Array( '".$sitem->parent."','',' ".JText::_('COM_PROPERTIES_FIELD_SELECTSTATE')." ' );"."\n";
					$x++;			
							}
						
		$return_js.="states[$x] = new Array( '".$sitem->parent."','".$sitem->id."','".str_replace('\'',"\'",JText::_($sitem->name))."' );\n";
		
		$x++;
					}
				}			
	
	//return $ComboStates;
return $return_js;
	}
	
	
	
	
	
	
	
	
	
	
	function getLocalities_js()
    { 
	$db 	= JFactory::getDBO(); 
	$return_js ='';
	
			$query = 'SELECT * FROM #__properties_locality WHERE published = 1 ORDER BY parent,name';	        
		$db->setQuery($query);
		$Localities = $db->loadObjectList();
		
		if($Localities){	
				$x=0;
				$tmp_parent=0;
				$return_js='';
						
					foreach ( $Localities as $sitem ) {
					
						if($tmp_parent!=$sitem->parent)
							{
							$tmp_parent=$sitem->parent;
					//$return_js.="localities[$x] = new Array( '".$sitem->parent."','',' ".JText::_('COM_PROPERTIES_FIELD_SELECTLOCALITY')." ' );"."\n";
					$x++;			
							}						
		$return_js.="localities[$x] = new Array( '".$sitem->parent."','".$sitem->id."','".str_replace('\'',"\'",JText::_($sitem->name))."' );\n";		
		$x++;
					}
				}
return $return_js;
	}
		
		
		
			public function getCoord($post)
	{
	
	$params		= JComponentHelper::getParams('com_properties');
		$AutoCoord=$params->get('AutoCoord',0);	
		$apikey=$params->get('MapApiKey',0);	
		
	

	$db 	=& JFactory::getDBO();

	$locid = $post['lid'];
    $stid = $post['sid'];
    $cnid = $post['cyid'];    

	$query1 = 'SELECT name FROM #__properties_country WHERE id = '.$post['cyid'];		
        $db->setQuery($query1);        
		$Country = $db->loadResult();
	$query2 = 'SELECT name FROM #__properties_state WHERE id = '.$post['sid'];		
        $db->setQuery($query2);        
		$State = $db->loadResult();
	$query3 = 'SELECT name FROM #__properties_locality WHERE id = '.$post['lid'];		
        $db->setQuery($query3);        
		$Locality = $db->loadResult();				
   
	$mapaddress = str_replace( " ", "%20", $post['address'].", ".$Locality.", ".$State.", ".$post['postcode'].", ".$Country );
        $file = "http://maps.google.com/maps/geo?q=".$mapaddress."&output=xml&key=".$apikey;
//echo  $file;
        $longitude = "";
        $latitude = "";
        if ( $fp = fopen( $file, "r" ) )
        {
            $coord = "<coordinates>";
            $coordlen = strlen( $coord );
            $r = "";
            while ( $data = fread( $fp, 32768 ) )
            {
                $r .= $data;
            }
            do
            {
                $foundit = stristr( $r, $coord );
                $startpos = strpos( $r, $coord );
                if ( 0 < strlen( $foundit ) )
                {
                    $mypos = strpos( $foundit, "</coordinates>" );
                    $mycoord = trim( substr( $foundit, $coordlen, $mypos - $coordlen ) );
                    list( $longitude, $latitude ) = split( ",", $mycoord );
                    $r = substr( $r, $startpos + 10 );
                }
            } while ( 0 < strlen( $foundit ) );
            fclose( $fp );
        }
	$coord = $latitude.','.$longitude;	
	//echo $coord;//require('a');
	return $coord;
	}
		
}
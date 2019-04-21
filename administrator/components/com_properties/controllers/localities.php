<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_properties
 * @copyright	Copyright (C) 2006 - 2016 Fabio Esteban Uzeltinger.
 * @email		fabiouz@gmail.com
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controlleradmin');

class PropertiesControllerLocalities extends JControllerLegacy//JControllerAdmin
{
	
	function &getModel($name = 'Locality', $prefix = 'PropertiesModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}

	function cargarBarrios(){

		$file = fopen(JPATH_SITE."/tmp/Barrios.csv","r");


		$fila = 1;
if (($gestor = fopen(JPATH_SITE."/tmp/Barrios.csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
        //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            echo $datos[$c] . "<br />\n";
		}
		


		$model		= $this->getModel();
		$data = null;
		$data = new JObject();
		//$data = $propiedad;
		$data->id = 0;
		$data->name = $datos[0];
		$data->parent = 1;
		$data->published = 1;

		$model->store($data);



    }
    fclose($gestor);
}



// I've also tried using fopen(JPATH_SITE."/html/temp/personnel.csv","r");    TRUNCATE TABLE `ou1ds_properties_locality`
// I've also tried fopen("/var/www/html/temp/personnel.csv","r");
// and fopen("/temp/personnel.csv","r");
/*
while(! feof($file))
  {
     echo "<br>" . (fgetcsv($file));
  }
fclose($file);
echo "<br>End Processing.";
*/
/*
		$model		= $this->getModel();
		$data = null;
		$data = new JObject();
		//$data = $propiedad;
		$data->id = (int) $propiedad->id_propiedad;
		$data->name = (int) $propiedad->id_propiedad;
		$data->published = 1;
		
		$existe = $this->getPropiedad($data->id);
		
		if(!$existe)
		{
			$existe = $this->addPropiedad($data->id);
		}
		*/

	}
}
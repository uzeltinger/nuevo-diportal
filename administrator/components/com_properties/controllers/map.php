<?php
// no direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

class PropertiesControllerMap extends JControllerForm
{




	
public function mapgetcoord()
	{ 	
		
JRequest::setVar( 'tmpl', 'component'  );
$params	= JComponentHelper::getParams('com_properties');
		$UseCountryDefault=$params->get('UseCountryDefault',0);				

$apikey    = $params->get( 'MapApiKey' );
$distancia= $params->get( 'MapDistance' );
$DefaultLat= $params->get( 'DefaultLat' );
$DefaultLng= $params->get( 'DefaultLng' );
$Pid 		= JRequest::getInt( 'id');
$db 	= JFactory::getDBO();
if($Pid)
{
$query = 'SELECT p.*,t.name AS name_category '
				. ' FROM #__properties_products AS p '
				. 'LEFT JOIN #__properties_category AS t ON t.id = p.cid '	
				. 'WHERE p.id = '.$Pid ;
$db->setQuery($query);	        
$Prod = $db->loadObject();
}

$lat= $DefaultLat;
$lng=$DefaultLng;
if(isset($Prod))
{
$lat=$Prod->lat!=0 ? $Prod->lat : $DefaultLat;
$lng=$Prod->lng!=0 ? $Prod->lng : $DefaultLng;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
  <head> 
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/> 
    <title>Google Maps JavaScript API Example</title> 
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo $apikey;?>"
      type="text/javascript"></script> 
   
  </head> 
<body style="width: 750px; height: 400px; padding:0px; margin:0px;"> 
<div id="map" style="width: 750px; height: 400px;"></div>  
<form action="" name="formgetcoord" method="post">
<input type="text" id="getlat" name="getlat" value="<?php echo $lat;?>" />
<input type="text" id="getlng" name="getlng" value="<?php echo $lng;?>" />

<button onclick="window.parent.jSelectCoord(document.getElementById('getlat').value,document.getElementById('getlng').value);SqueezeBox.close();" value="<?php echo JText::_( 'Add Coord' );?>"><?php echo JText::_( 'Add Coord' );?></button>



</form>  

<script>
var map;
var markers = [];

function initMap() {
	var myLatlng = {lat: <?php echo $lat;?>, lng: <?php echo $lng;?>};
  	map = new google.maps.Map(document.getElementById('map'), {
	center: myLatlng,
	zoom: <?php echo $distancia;?>
  });

  var marker = new google.maps.Marker({
	position: myLatlng,
	map: map,
	title: 'Click to zoom'
  });

map.addListener('click', function(event) {

	deleteMarkers();
	addMarker(event.latLng);
	addMarker(myLatlng);

	var matchll = /\(([-.\d]*), ([-.\d]*)/.exec( event.latLng );
	if ( matchll ) { 
		var lat = parseFloat( matchll[1] );
		var lon = parseFloat( matchll[2] );
		lat = lat.toFixed(6);
		lon = lon.toFixed(6);
		var message = "lat=" + lat + "<br>lon=" + lon + " "; 
		var messageRoboGEO = lat + ";" + lon + ""; 
	} else { 
		var message = "<b>Error extracting info from</b>:" + point + ""; 
		var messagRoboGEO = message;
	}	  
		document.getElementById("getlat").value = lat;
		document.getElementById("getlng").value = lon;	
});
}
// Adds a marker to the map and push to the array.
function addMarker(location) {
	var marker = new google.maps.Marker({
	  position: location,
	  map: map
	});
	markers.push(marker);
  }
  // Sets the map on all markers in the array.
  function setMapOnAll(map) {
	for (var i = 0; i < markers.length; i++) {
	  markers[i].setMap(map);
	}
  }
  // Removes the markers from the map, but keeps them in the array.
  function clearMarkers() {
	setMapOnAll(null);
  }
  // Shows any markers currently in the array.
  function showMarkers() {
	setMapOnAll(map);
  }
  // Deletes all markers in the array by removing references to them.
  function deleteMarkers() {
	clearMarkers();
	markers = [];
  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apikey;?>&callback=initMap"
async defer></script>

</body> 
</html> 
<?php }
}

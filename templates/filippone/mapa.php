<div class="col-ss-12 col-xs-12 sedes-mapa">
    <div class="sedes-mapa-inner">
        <div id="map" style="height: 220px; position: relative; background-color: rgb(229, 227, 223); overflow: hidden;"></div>
    </div>
    <div class="sedes-mapa-footer">
    </div>
</div>                
<script>
    //-31.4692762,-64.1635592
var map;
var sede1 = {lat: -38.7088299, lng: -62.2625221};
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: sede1
        });
        setMarkers(map,sede1);     
    }
	function setMarkers(map,sede) {
		var marker = new google.maps.Marker({
            position: sede,
            map: map
        });
	}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-EVZUhPdnn8J2V3Rprf87BE0wSiYrs28&callback=initMap">
</script>

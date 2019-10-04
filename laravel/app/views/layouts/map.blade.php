<script type="text/javascript">

	var locations = {{$mapPlaces}};
	var map;
	var marker, i;
	var infowindow;

	function initMap() {
	  map = new google.maps.Map(document.getElementById('map'), {
	    center: {lat: 35.6940511, lng: 51.4147924},
	    zoom: 10,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		streetViewControl: false,
	  });

	  infowindow = new google.maps.InfoWindow();

	  for (i = 0; i < locations.length; i++) {

		marker = new google.maps.Marker({
			map: map,
			draggable: false,
			animation: google.maps.Animation.DROP,
			position: {lat: locations[i].lat, lng: locations[i].long}
		});

		google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
		return function() {
			// infowindow.setContent('<p>'+locations[i].title+'</p>');
			// infowindow.open(map, marker);
			infowindow.setContent('<a class="infowindow_style" href="restaurant/'+locations[i].url+'">'+locations[i].title+'</a>');
		    infowindow.open(map, marker);
		}
		})(marker, i));

		// google.maps.event.addListener(marker, 'click', (function(marker, i) {
		// 	return function() {
		// 	    infowindow.setContent('<a href="restaurant/'+locations[i].url+'">'+locations[i].title+'</a>');
		// 	    infowindow.open(map, marker);
		// 	}
		// })(marker, i));

		}
	}


	function toggleBounce() {
	  if (marker.getAnimation() !== null) {
		marker.setAnimation(null);
	  } else {
		marker.setAnimation(google.maps.Animation.BOUNCE);
	  }
	}


	//
	// var map = new google.maps.Map(document.getElementById('map'), {
	// 	zoom: 11,
	// 	center: new google.maps.LatLng(35.6940511, 51.4147924),
	// 	mapTypeId: google.maps.MapTypeId.ROADMAP,
	// 	streetViewControl: false,
	// });
	//
	// var infowindow = new google.maps.InfoWindow();
	//
	// var marker, i;
	//

	// for (i = 0; i < locations.length; i++) {
	// 	marker = new google.maps.Marker({
	// 		position: new google.maps.LatLng(locations[i].lat, locations[i].long),
	// 		map: map
	// 	});
	//
	// 	google.maps.event.addListener(marker, 'click', (function(marker, i) {
	// 	  return function() {
	// 	    infowindow.setContent('<a href="restaurant/'+locations[i].url+'">'+locations[i].title+'</a>');
	// 	    infowindow.open(map, marker);
	// 	  }
	// 	})(marker, i));
	//
	// 	// google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
	// 	// 	return function() {
	// 	// 		infowindow.setContent(locations[i].title);
	// 	// 		infowindow.open(map, marker);
	// 	// 	}
	// 	// })(marker, i));
	// }


	// locations.push(marker);

	// var mcOptions = {gridSize: 50, maxZoom: 15};

	// var markerCluster = new MarkerClusterer(map, marker);


</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDqR3GeWC7x8XYCNNRdZEHO1trW_-Pmf0M&callback=initMap"
    async defer></script>

<?php include 'connect/db.php'; ?>
<?php if(!empty($_REQUEST['post_id'])): $post_id = $_REQUEST['post_id'];?>
  <?php $getPost = mysqli_query($dbc,"SELECT * FROM post WHERE id='$post_id'");
    $fetchPost =mysqli_fetch_assoc($getPost);
    $cat = fetchById($dbc,"exp_categories",$fetchPost['cat_id']);
  $trip = fetchById($dbc,"trip",$fetchPost['trip_id']);
  $along = explode(',', $fetchPost['along']);
  $loc_id = $trip['location_id'];
  $location = fetchById($dbc,"location",$loc_id);
  $name="";
   foreach($along as $val):
  $user = fetchById($dbc,"users",$val);
      $name.=' <a href="index.php?nav=user_profile&user_id='.$val.'"><label for="" class="label label-default">'.$user['name'].'</label></a>';
     endforeach; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
   <meta charset="utf-8">
    <link rel="stylesheet" href="links/style.css">
    <title>Find your Location</title>
  </head>
  <body>
  <div class="container">
  	<div class="options-box">
  		<h1>Find your Location</h1>
  		<div>
  			<input id="show-listings" type="button" value="Show listing">
  			<input id="hide-listings" type="button" value="Hide listing">
  		</div>
  	</div>
  </div>

      <div id="map"></div>
    <script>
    	var map;

      // Create a new blank array for all the listing markers.
      var markers = [];
      function initMap() {
        // Create a styles array to use with the map.
        var styles = [
          {
            featureType: 'water',
            stylers: [
              { color: '#19a0d8' }
            ]
          },{
            featureType: 'administrative',
            elementType: 'labels.text.stroke',
            stylers: [
              { color: '#ffffff' },
              { weight: 6 }
            ]
          },{
            featureType: 'administrative',
            elementType: 'labels.text.fill',
            stylers: [
              { color: '#e85113' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'geometry.stroke',
            stylers: [
              { color: '#efe9e4' },
              { lightness: -40 }
            ]
          },{
            featureType: 'transit.station',
            stylers: [
              { weight: 9 },
              { hue: '#e85113' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'labels.icon',
            stylers: [
              { visibility: 'off' }
            ]
          },{
            featureType: 'water',
            elementType: 'labels.text.stroke',
            stylers: [
              { lightness: 100 }
            ]
          },{
            featureType: 'water',
            elementType: 'labels.text.fill',
            stylers: [
              { lightness: -100 }
            ]
          },{
            featureType: 'poi',
            elementType: 'geometry',
            stylers: [
              { visibility: 'on' },
              { color: '#f0e4d3' }
            ]
          },{
            featureType: 'road.highway',
            elementType: 'geometry.fill',
            stylers: [
              { color: '#efe9e4' },
              { lightness: -25 }
            ]
          }
        ];
      // function initMap() {
        // Constructor creates a new map - only center and zoom are required.
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 31.42, lng: 73.00},
          zoom: 20,
          styles: styles,
          mapTypeControl: false
        });
        // These are the real estate listings that will be shown to the user.
        // Normally we'd have these in a database instead.
        var locations = [
          {
            title:'Trip: <?=$trip['name']?>'+'<br>'+'Title: <?=$fetchPost['title']?>'+'<br>'+'Description:  '+'<?=$fetchPost['description']?><br>'+'Friends: <?=$name?>',
            location:{lat:<?=$_REQUEST['lat']?>,lng:<?=$_REQUEST['lng']?>}
          }
        // {title:'Name: Asfand'+'<br>'+'Phone: 03360613420'+'<br>'+'Address:  '+'<br>'+'Blood Group: ',location:{lat:31.417227,lng:73.060013}},
        // {title:'Name: Jahanzaib'+'<br>'+'Phone: 03360613420'+'<br>'+'Address:  '+'<br>'+'Blood Group: ',location:{lat:31.411695,lng:73.061747}},
        // {title:'Name: Addel'+'<br>'+'Phone: 03360613420'+'<br>'+'Address:  '+'<br>'+'Blood Group: ',location:{lat:31.423549,lng:73.061381}},
        // {title:'Name: Hassan'+'<br>'+'Phone: 03360613420'+'<br>'+'Address:  '+'<br>'+'Blood Group: ',location:{lat:31.425096,lng:73.051140}}
        ];
        var largeInfowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
    	// var image = {
     //      url: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
     //      size: new google.maps.Size(20, 32),
     //      origin: new google.maps.Point(0, 0),
     //      anchor: new google.maps.Point(0, 32)
     //    };
     // Style the markers a bit. This will be our listing marker icon.
        var defaultIcon = makeMarkerIcon('0091ff');
        // Create a "highlighted location" marker color for when the user
        // mouses over the marker.
        var highlightedIcon = makeMarkerIcon('FFFF24');
         var largeInfowindow = new google.maps.InfoWindow();

    	// ----------- funtion to shapes define the clickable region----
    	// var shape ={
    	// 	coords:[1,1,1,20,18,20,1],
    	// 	type:'poly'
    	// };	

    		// The following group uses the location array to create an array of markers on initialize.
        for (var i = 0; i < locations.length; i++) {
          // Get the position from the location array.
          var position = locations[i].location;
          var title = locations[i].title;
          var address = locations[i].title;
          var phone = locations[i].title;
          // Create a marker per location, and put into markers array.
          var marker = new google.maps.Marker({
            map: map,
            //icon:image,
            // shape,shape,
            position: position,
            title: title,
            animation: google.maps.Animation.DROP,
            icon: defaultIcon,
            id: i
          });
    		// Push the marker to our array of markers.
          markers.push(marker);
          // Create an onclick event to open an infowindow at each marker.
          marker.addListener('click', function() {
            populateInfoWindow(this, largeInfowindow);
          });
          bounds.extend(markers[i].position);
          // Two event listeners - one for mouseover, one for mouseout,
          // to change the colors back and forth.
          marker.addListener('mouseover', function() {
            this.setIcon(highlightedIcon);
          });
          marker.addListener('mouseout', function() {
            this.setIcon(defaultIcon);
          });
        }
        // Extend the boundaries of the map for each marker
        map.fitBounds(bounds);
 		document.getElementById('show-listings').addEventListener('click', showListings);
        document.getElementById('hide-listings').addEventListener('click', hideListings);
      }
    	function populateInfoWindow(marker, infowindow) {
    		if(infowindow.marker != marker)
    		{
    			infowindow.marker = marker;
    			infowindow.setContent('<div>' + '<img width="100" height="100" src="post_uploads/<?=$fetchPost['pic']?>">' +  '<hr>'+'<h3>' + marker.title +'</h3>'+'<h3>'+marker.position+'</h3>'+'</div>' );

    			infowindow.open(map, marker);
    			infowindow.addListener('closeclick',function(){
    				infowindow.setMarker(null);
    			});

    		}
    	}
    	// This function will loop through the markers array and display them all.
      function showListings() {
        var bounds = new google.maps.LatLngBounds();
        // Extend the boundaries of the map for each marker and display the marker
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
          bounds.extend(markers[i].position);
        }
        map.fitBounds(bounds);
      }
      // This function will loop through the listings and hide them all.
      function hideListings() {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
        }
      }	
      // This function takes in a COLOR, and then creates a new marker
      // icon of that color. The icon will be 21 px wide by 34 high, have an origin
      // of 0, 0 and be anchored at 10, 34).
      function makeMarkerIcon(markerColor) {
        var markerImage = new google.maps.MarkerImage(
          'http://chart.googleapis.com/chart?chst=d_map_spin&chld=1.15|0|'+ markerColor +
          '|40|_|%E2%80%A2',
          new google.maps.Size(21, 34),
          new google.maps.Point(0, 0),
          new google.maps.Point(10, 34),
          new google.maps.Size(21,34));
        return markerImage;
      }
      
    </script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCDPQN2uYUYRYeSBT0IkyPa9B594tdSVU4&v=3&callback=initMap"></script>

   
  </body>
</html>
  <?php else: ?>
    <h1>No Post Available</h1>
<?php  endif; ?>

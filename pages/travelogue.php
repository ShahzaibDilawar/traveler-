<style>
	body{
		background-image: url('img/bgtravel.jpeg');
		background-position: center center;
		background-attachment: fixed;
		background-size: cover;
	}
</style>
<div class="row">
	<div class="col-sm-3">
		<div class="list-group">
			<a class="list-group-item" data-toggle="modal" href='#trip'>
				<span class="glyphicon glyphicon-plus"></span> Add New Trip</a>
			<a href="index.php?nav=experience" class="list-group-item"><span class="glyphicon glyphicon-ok"></span> Experience Status</a>
			<a href="index.php?nav=viewExp" class="list-group-item"><span class="glyphicon glyphicon-eye-open"></span> View Experience</a>
		</div>
	</div>
</div>





<!-- Modal Area -->

	<!-- Trip Modal -->
	<div class="modal fade" id="trip">
	<span id="tripResponse"></span>
	<form action="ajax/addTrip.php" method="POST" role="form" id="addTripForm">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Add / Edit Trip</h4>
				</div>
				<div class="modal-body">
					
					
						<div class="form-group">
							<label for="">Name</label>
							<input type="text" required class="form-control" name="name" placeholder="Trip Name">
						</div>
						<div class="form-group">
						<br>
							<button type="button" class="btn btn-warning" onclick="getLocation()"><span class="glyphicon glyphicon-screenshot"></span> Get Location</button>
						</div>
					<input type="hidden" name="lng" id="lng">
					<input type="hidden" name="lat" id="lat">
					
						<p id="demo"></p>
					<div id="mapholder"></div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>

				</div>
			</div>
		</div>
	</div>
	</form>
	<!-- Trip Modal -->

<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var latlon = position.coords.latitude + "," + position.coords.longitude;
      x.innerHTML = "Latitude: " + position.coords.latitude +
    "<br>Longitude: " + position.coords.longitude;
    document.getElementById('lat').value=position.coords.latitude;
        document.getElementById('lng').value=position.coords.longitude;
      document.getElementById('lat').value=position.coords.latitude;
        document.getElementById('lng').value=position.coords.longitude;

    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="
    +latlon+"&zoom=14&size=500x300&sensor=false&key=AIzaSyCDPQN2uYUYRYeSBT0IkyPa9B594tdSVU4";
    document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
}

//To use this code on your website, get a free API key from Google.
//Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
</script>
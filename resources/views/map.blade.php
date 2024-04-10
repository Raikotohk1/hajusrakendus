<!--<!DOCTYPE html>
<html>

<head>
    <title>Google Map Example</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <h1>Google Map Example</h1>
    <div id="map"></div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -34.397,
                    lng: 150.644
                },
                zoom: 3
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap">
    </script>
</body>

</html>-->

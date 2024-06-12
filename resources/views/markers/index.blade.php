<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radar Map</title>
    <link href="https://js.radar.com/v4.1.18/radar.css" rel="stylesheet">
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        #map-container {
            height: 100%;
            position: relative;
            width: 100%;
        }

        #map {
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="map-container">
        <div id="map" style="width: 100%; height:500px;"></div>

    </div>

    <script src="https://js.radar.com/v4.1.18/radar.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mapContainer = document.getElementById('map');
            const mapKey = {!! json_encode($mapKey) !!}; // Accessing API key from .env file

            Radar.initialize(mapKey);

            const map = Radar.ui.map({
                container: mapContainer,
                style: 'radar-default-v1',
                center: [ 22.4919, 58.2550 ], // NYC
                zoom: 11
            });

            const markers = {!! json_encode($markers) !!};

            markers.forEach(markerInfo => {
                const marker = Radar.ui.marker({ text: markerInfo.description })
                    .setLngLat([markerInfo.latitude, markerInfo.longitude])
                    .addTo(map);
            });

            // Add marker function
            function addMarkerOnClick(e) {
                const coordinates = e.lngLat;
        
                    var lat = coordinates.lat;
                    var lng = coordinates.lng;
                Radar.ui.marker({
                        color: '#ff0000' // Red color for the markers added by click
                    })
                    .setLngLat(coordinates)
                    .addTo(map);
                    fillForm(lat, lng);
            }
            function fillForm(lat, lng) {
                var latInput = document.getElementById('latitude');
                var lngInput = document.getElementById('longitude');

                if (latInput && lngInput) {
                    latInput.value = lng;
                    lngInput.value = lat;

                } else {
                    console.error("Latitude or longitude input element not found.")
                }
            }
            // Add event listener for click on map
            map.on('dblclick', addMarkerOnClick);

            // Function to remove map when the page is unloaded
            window.addEventListener('beforeunload', function () {
                map.remove();
            });
        });
    </script>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#markerModal">
        Add Marker
    </button>

    <!-- Modal -->
    <div class="modal fade" id="markerModal" tabindex="-1" role="dialog" aria-labelledby="markerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="markerModalLabel">Create Marker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Marker creation form -->
                    <form id="markerForm" action="{{ route('markers.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" required>
                        </div>
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Marker</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

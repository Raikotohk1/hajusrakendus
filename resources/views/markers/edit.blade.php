<!-- Edit Marker Modal -->
<div class="modal fade" id="editMarkerModal" tabindex="-1" role="dialog" aria-labelledby="editMarkerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMarkerModalLabel">Edit Marker</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Edit marker form -->
                <form id="editMarkerForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="editName">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="editLatitude">Latitude</label>
                        <input type="text" class="form-control" id="editLatitude" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="editLongitude">Longitude</label>
                        <input type="text" class="form-control" id="editLongitude" name="longitude" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Marker</button>
                </form>
            </div>
        </div>
    </div>
</div>

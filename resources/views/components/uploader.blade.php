<button type="button" class="btn btn-info btn-block mt-4" data-toggle="modal" data-target="#uploader">
    upload
</button>

<div class="modal fade" id="uploader" tabindex="-1" role="dialog" aria-labelledby="uploaderLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="uploaderLabel">Upload a Photo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('posts') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input type="file" name="image" class="input-img">
                    <div class="modal-btns">
                        <input type="submit" class="btn btn-outline-success" value="Upload!">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

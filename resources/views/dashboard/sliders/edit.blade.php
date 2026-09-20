<div class="modal" id="EditSlider">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Edit Slider</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="EditSliderForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="slider_id" id="slider_id_edit">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_slug_edit">Note / Product</label>
                        <input type="text" name="product_slug" id="product_slug_edit" class="form-control"
                            placeholder="Enter note or product slug">
                        <span class="text-danger error-text" id="product_slug_edit_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="singlimage_edit">Image</label>
                        <input type="file" name="file_name" id="singlimage_edit" accept="image/*" class="form-control">
                        <span class="text-danger error-text" id="file_name_edit_error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

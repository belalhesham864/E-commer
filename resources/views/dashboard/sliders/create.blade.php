<div class="modal" id="createSlider">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Create Slider</h6>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="createSlider2" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_slug">Note / Product</label>
                        <input type="text" name="product_slug" id="product_slug" class="form-control"
                            value="{{ old('product_slug') }}" placeholder="Enter note or product slug">
                        <span class="text-danger error-text" id="product_slug_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="singlimage">Image</label>
                        <input type="file" name="file_name" id="singlimage" accept="image/*" class="form-control">
                        <span class="text-danger error-text" id="file_name_error"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

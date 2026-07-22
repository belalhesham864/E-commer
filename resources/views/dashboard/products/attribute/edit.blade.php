     <div  class="modal" id="editattribute">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Edit Attribute</h6>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                          <div class="alert alert-danger" id="edit_alert_div" style="display: none">
                            <ul id="edit_error_list"></ul>
                          </div>
                                        <form action="" id="edit_attribute" method="post"
                                            >
                                            @csrf

                                            <div class="modal-body">
                                             
                                                <input type="hidden" name="id" id="attributeid">

                                                <div class="form-group">
                                                    
                                                    <label for="name">Attribute Name</label>
                                                    <input type="text" name="name" id="editname"  class="form-control"
                                                        value="{{ old('name') }}" placeholder="Enter Attribute Name ">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <hr>

       <div id="attribute-values-continer">
        
</div>

<div class="text-right mt-2"><button type="button" id="add-value_edit" class="btn btn-primary">
    +
</button></div>
    <br>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
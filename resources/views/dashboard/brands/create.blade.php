     <div  class="modal" id="createBrand">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Create Brand</h6>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('dashboard.brands.store') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label for="name">{{ __('words.name_en') }}</label>
                                                    <input type="text" name="name[en]" id="name" class="form-control"
                                                        value="{{ old('name.en') }}" placeholder="Enter brand name">
                                                    @error('name.en')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">{{ __('words.name_ar') }}</label>
                                                    <input type="text" name="name[ar]" id="name" class="form-control"
                                                        value="{{ old('name.ar') }}" placeholder="Enter brand name arabic">
                                                    @error('name.ar')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="logo">Logo</label>
                                                    <input type="file" name="logo" id="singlimage" accept="image/*"
                                                        class="form-control"
                                                        onchange="previewLogo(event)">
                                                    @error('logo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                    
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-2">Status</label>
                                                    <div>
                                                        <input type="radio" name="status" id="status"
                                                           value="1" >
                                                        <label for="status">Active</label>
                                                        <input type="radio" name="status" id="status"
                                                           value="0" >
                                                        <label for="status">InActive</label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
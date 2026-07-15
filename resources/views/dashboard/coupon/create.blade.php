     <div  class="modal" id="createcoupon">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Create Coupon</h6>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                          <div class="alert alert-danger" id="alert_div" style="display: none">
                            <ul id="error_list"></ul>
                          </div>
                                        <form action="" id="create_coupon" method="post"
                                            >
                                            @csrf

                                            <div class="modal-body">


                                                <div class="form-group">
                                                    <label for="name">Code</label>
                                                    <input type="text" name="code"  class="form-control"
                                                        value="{{ old('code') }}" placeholder="Enter code ">
                                                    @error('code')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Discount Precentage</label>
                                                    <input type="number" name="discount_precentage"  class="form-control"
                                                        value="{{ old('discount') }}" placeholder="Enter Discount Precentage">
                                                    @error('discount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>


                                                <div class="form-group">
                                                    <label for="">start Date</label>
                                                    <input type="date" name="start_date" 
                                                        class="form-control" 
                                                       >
                                                    @error('start_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="">End Date</label>
                                                    <input type="date" name="end_date" 
                                                        class="form-control"
                                                       
                                                       >
                                                    @error('end_date')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Limit</label>
                                                    <input type="number" name="limit" 
                                                        class="form-control"
                                                      
                                                       >
                                                    @error('limit')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                    
                                                </div>

                                                <div class="form-group">
                                                    <label class="mr-2">Status</label>
                                                    <div>
                                                        <input type="radio" name="is_active" 
                                                           value="1" >
                                                        <label for="is_active">Active</label>
                                                        <input type="radio" name="is_active" 
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
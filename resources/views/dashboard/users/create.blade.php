     <div  class="modal" id="editUser">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Edit User</h6>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form
                                        id="createUser2"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" id="name" class="form-control"
                                                         placeholder="Enter User Name">
                                               <span class="text-danger" id="error-name"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">phone</label>
                                                    <input type="number" name="phone" id="phone" class="form-control"
                                                         placeholder="Enter User phone">
                                                  <span class="text-danger" id="error-phone"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Email</label>
                                                    <input type="text" name="email" id="email" class="form-control"
                                                         placeholder="Enter User email">
                                                 <span class="text-danger" id="error-email"></span>
                                                </div>


                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control"
                                                        >
                                                <span class="text-danger" id="error-password"></span>


                                                </div>

                                                     @livewire('general.drop-down-country-dependented')


                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" id="sumbitUser" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

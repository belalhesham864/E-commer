        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a href="{{ route('dashboard.coupons.edit', $coupon->id) }}" id="edit-btn" coupon-id="{{ $coupon->id }}" class="btn btn-outline-success">Edit <i
                        class="la la-edit"></i></a>
               
                   
                            <button type="submit" coupon-id="{{ $coupon->id }}" class="delete_confirm_btn btn btn-outline-danger">Delete <i class="la la-trash"></i></button>

                       
            </div>
        </div>

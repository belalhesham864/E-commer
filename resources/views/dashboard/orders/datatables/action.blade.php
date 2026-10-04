        <div class="form-group">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a  href="{{ route('dashboard.orders.show',$order->id) }}" class="btn btn-outline-info">Show <i
                        class="la la-eye"></i></a>
            </div>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <button type="button" order-id="{{ $order->id }}" class="delete_confirm_order btn btn-outline-danger">Delete <i
                        class="la la-trash"></i></button>
            </div>
        </div>

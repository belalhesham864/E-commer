          
@forelse($governrates as $governrate)

<tr>
    <th>{{ $loop->iteration }}</th>

    <td>
        <a href="{{ route('dashboard.world.countries.governrates.index', $governrate->id) }}">
            {{ $governrate->name }}
        </a>
    </td>

    <td>
        {{ $governrate->country->name }}
    </td>

    <td class="text-center">
        <span class="badge badge-pill badge-info">
            {{ $governrate->cities->count() }}
        </span>
    </td>

    <td class="text-center">
        <span class="badge badge-pill badge-info">
            {{ $governrate->users->count() }}
        </span>
    </td>
        <td id="status_{{ $governrate->id }}">@if ($governrate->is_active==0)
                                                        <div class="badge badge-danger">Not Active</div>    
                                                        @else
                                                        <div class="badge badge-success">Active</div>    
                                                        
                                                    @endif</td>
    <td>
        <input
            type="checkbox"
            class="switch change_status"
            governrate-id="{{ $governrate->id }}"
            id="switch{{ $governrate->id }}"
            {{ $governrate->is_active ? 'checked' : '' }}
            data-group-cls="btn-group-sm">
    </td>

    <td class="price-shipping_{{ $governrate->id }}">
        {{ $governrate->shippingPrice->price }} $
    </td>

    <td>
        <a class="text-secondary"
           data-toggle="modal"
           href="#price{{ $governrate->id }}">
            <i class="ft-refresh-cw mr-1"></i>
            Change Price
        </a>
    </td>
</tr>

<div class="modal fade" id="price{{ $governrate->id }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Change Shipping Price</h5>

                <button type="button"
                        class="close"
                        data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <form action=""
            class="update_price"
            gov-id="{{ $governrate->id }}"
                  method="POST">

                @csrf
                @method('PUT')
    <div class="alert alert-danger" style="display: none" id="errors_{{ $governrate->id }}"></div>
                <div class="modal-body">

                    <label>Shipping Price</label>

                    <input type="number"
                           class="form-control"
                           name="shpping_price"
                           value="{{ $governrate->shippingPrice->price }}"
                           >

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal">
                        Close
                    </button>

                    <button class="btn btn-primary">
                        Update
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

@empty

<tr>
    <td colspan="8" class="text-center">
        No Governrates Found
    </td>
</tr>

@endforelse

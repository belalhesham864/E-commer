<div class="dropdown float-md-right">

    <button class="btn btn-danger dropdown-toggle round btn-glow px-2" type="button"
        id="dropdownActions{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Action
    </button>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownActions{{ $row->id }}">
        <a product-id="{{ $row->id }}" class="dropdown-item"
            href="{{ route('dashboard.products.edit', $row->id) }}">
            <i class="ft-edit-3 mr-1"></i>
            Edit
        </a>

        <a product-id="{{ $row->id }}" class="dropdown-item"
            href="{{ route('dashboard.products.show', $row->id) }}"> <i class="ft-eye mr-1"></i>
            Show
        </a>

<a
    href="#"
    product-id="{{ $row->id }}"
    class="dropdown-item text-danger delete_confirm"
>
    <i class="ft-trash mr-1"></i>
    Delete
</a>

        <a href="#" product-id="{{ $row->id }}" class="dropdown-item change_statusProduct">
              <i class="fas fa-exchange-alt"></i>
            Change Status
        </a>



    </div>

</div>

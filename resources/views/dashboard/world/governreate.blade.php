@extends('layout.dashboard.app')

@section('title')
  Governrates
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Basic Forms</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.welcome') }}">{{__('words.Home')}}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index')  }}">{{ __('words.Roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create')  }}"> {{ __('words.Create Roles') }}
                                        </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
               @include('dashboard.includes.buttonheader')

            </div>
            <div class="card">
<input type="search"
 id="search"
       class="form-control w-25"
       name="search"
       placeholder="Search...">
                   <div class="card-content collapse show">
                    {{-- alert --}}
              @include('dashboard.includes.toster-error')
              @include('dashboard.includes.toster-success')

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Number of cities</th>
                                    <th>Number of users</th>
                                       <th>Status</th>
                                    <th>Change Status</th>
                                    <th>Shpping Price</th>
                                    <th>Change price</th>
                                </tr>
                            </thead>

             <tbody id="governrate-table">
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
            {{ $governrate->cities_count }}
        </span>
    </td>

    <td class="text-center">
        <span class="badge badge-pill badge-info">
            {{ $governrate->users_count }}
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
</tbody>
                    </table>
              {{ $governrates->links() }}
                </div>
          
            </div>

        </div>

    </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('asset/dashboard') }}/vendors/js/forms/icheck/icheck.min.js"></script>

<script src="{{ asset('asset/dashboard') }}/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>

<script src="{{ asset('asset/dashboard') }}/js/scripts/tables/components/table-components.js"></script>

<script>
    $(function(){
        $('.change_status').on('change',function(){
            var governrate_id=$(this).attr('governrate-id');
           var url="{{ route('dashboard.world.governrate.status',':id') }}";
           url=url.replace(':id',governrate_id);
           $.ajax({
            url:url,
            type:'GET',
            success: function(response){
                if(response.status==true){

                    $('.tostar_success').text(response.msg);
                    $('.tostar_success').show();
        
           if (response.data.is_active == 1) {

            $('#status_' + response.data.id).html(
                '<div class="badge badge-success">Active</div>'
            );

        } else {

            $('#status_' + response.data.id).html(
                '<div class="badge badge-danger">Not Active</div>'
            );

        }
                }else{
                     $('.tostar_error').text(response.msg);
            $('.tostar_error').show();
                }
          setTimeout(() => {
              $('.tostar_success').hide();
           }, 2000);
           
            },

           });
        });
    });
</script>

<script>
    $(document).on('submit','.update_price',function(e){
        e.preventDefault();
        var data = new FormData($(this)[0]);
         var form= $(this);
        var id =$(this).attr('gov-id');
        var url="{{ route('dashboard.world.governrate.price',':id') }}";
        url=url.replace(':id',id);
        $.ajax({
            url:url,
            type:"POST",
            data:data,
            processData:false,
            contentType:false,
            success: function(response){
                if(response.status==true){

                    $('.tostar_success').text(response.msg);
                    
                    $('.tostar_success').show();
                    
                    
                    $('.price-shipping_'+response.data.id).empty();
                    $('.price-shipping_'+response.data.id).text(response.data.price+'$');
                   form.closest('.modal').modal('hide');
            
                }
                setTimeout(() => {
                    $('.tostar_success').hide();
 
                }, 2000);
            },
            error: function(data){
            var response= $.parseJSON(data.responseText);
             $('#errors_'+id).text(response.errors.shpping_price[0]).show();

             setTimeout(() => {
                  $('#errors_'+id).hide();
             }, 2000);
            }
        });
    });
</script>
<script>
     let depounce;
    $(document).on('input','#search',function(e){
       e.preventDefault();
       var search =$(this).val();
       clearTimeout(depounce);
       depounce= setTimeout(() => {
            $.ajax({
        url:window.location.href,
        type:'GET',
        data:{
            search:search
        },
   
        success: function(response){
               $('#governrate-table').html(response);
                  $('.switch:checkbox').checkboxpicker();

        },

       });
        }, 1000); 
           });
</script>

@endpush

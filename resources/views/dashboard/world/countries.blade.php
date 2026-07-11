@extends('layout.dashboard.app')

@section('title')
  Countries
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
                                    <th>Phone Code</th>
                                    <th>Number of Governreate</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ( $countries as $country )
                                    
                               
                                    
                               
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td ><a href="{{ route('dashboard.world.countries.governrates.index',$country->id) }}">{{ $country->name }}</a> <i class="flag-icon flag-icon-eg"></i></td>
                                                  <td>
                                                    <fieldset class="form-group position-relative has-icon-left">
    <input disabled type="text" class="form-control" id="iconLeft"
           value="{{ $country->phone_code }}">
    <div class="form-control-position">
        <i class="ft-phone-call primary"></i>
    </div>
</fieldset>
                                                  </td>
                                                    <td class="text-center width-350">
                          <div class="badge badge-pill badge-info">{{ $country->governrates_count }}</div>
                        </td>
                                                    <td id="status_{{ $country->id }}">@if ($country->is_active==0)
                                                        <div class="badge badge-danger">Not Active</div>    
                                                        @else
                                                        <div class="badge badge-success">Active</div>    
                                                        
                                                    @endif</td>

<td>
    <input type="checkbox"
           class="switch change_status"
           country-id="{{ $country->id }}"
           id="switch{{ $country->id }}"
           {{ $country->is_active ? 'checked' : '' }}
           data-group-cls="btn-group-sm">
</td>
                               </tr>

                                @empty
                                    <td colspan="4">No Country Found</td>
                                 @endforelse 


                    </tbody>
                    </table>
              
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
    $(function () {

    $('.change_status').on('change', function () {


        var country_id = $(this).attr('country-id');

        var url = "{{ route('dashboard.world.countries.status', ':id') }}";
        url = url.replace(':id', country_id);

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
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
            }
        });

    });

});
</script>

@endpush

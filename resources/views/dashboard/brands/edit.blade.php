@extends('layout.dashboard.app')
@section('title')
    Edit Brand
@endsection
@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('words.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">Admins</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.admins.create') }}"> Create
                                        Admin
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                @include('dashboard.includes.buttonheader')

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">Edit Brand</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('dashboard.includes.valditionerror')
                            <form class="form" action="{{ route('dashboard.brands.update', $brand->id) }} " enctype="multipart/form-data"
                                method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <h4 class="form-section"><i class="fas fa-pen"></i> Edit Brand</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> Name English</label>
                                                <input type="text" value="{{ $brand->getTranslation('name', 'en') }}"
                                                    id="userinput1" class="form-control border-primary" placeholder="Name"
                                                    name="name[en]">
                                                @error('name.en')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> Name Arabic</label>
                                                <input type="text" value="{{ $brand->getTranslation('name', 'ar') }}"
                                                    id="userinput1" class="form-control border-primary" placeholder="Name"
                                                    name="name[ar]">
                                                @error('name.ar')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>
                                      <div class="row">
                                        <div class="col-md-12">

                                          <div class="form-group">
                                                    <label for="logo">Logo</label>
                                                    <input type="file" name="logo" id="singlimage-edit" accept="image/*"
                                                        class="form-control"
                                                        onchange="previewLogo(event)">
                                                    @error('logo')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror


                                                </div>
                                                </div>

                                      </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                           <input @checked($brand->status==1) type="radio" name="status" id="status"
                                                              value="1" >
                                                        <label for="status">Active</label>
                                                        <input @checked($brand->status==0) type="radio" name="status" id="status"
                                                           value="0" >
                                                        <label for="status">InActive</label>
                                                @error('status')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>



                                </div>
                                <div class="form-actions d-flex justify-content-between">

                                    <div>
                                        <a href="{{ url()->previous() }}" type="button" class="btn btn-warning mr-1">
                                            <i class="ft-x"></i> Cancel
                                        </a>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Update
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(function (){
        $('#singlimage-edit').fileinput({
    theme: 'fa5',
              showCancel: true,

                 maxFileCount: 1,
    showUpload: false,
    showRemove: true,
    enableResumableUpload: false,
    browseLabel: 'select image',
    initialPreviewAsData: true,
    initialPreview:[
    "{{ asset($brand->logo) }}"
    ],
        });

    });
</script>


@endpush

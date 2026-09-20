@extends('layout.dashboard.app')
@section('title')
    Create Page
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('vendor/SummerNote/summernote-bs4.min.css') }}">
@endpush
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
                        <h4 class="card-title" id="basic-layout-colored-form-control">Create Page</h4>
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
                            <form class="form" action="{{ route('dashboard.pages.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                    <h4 class="form-section"><i class="fas fa-pen"></i> Create Page</h4>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1"> Title</label>
                                                <input type="text"
                                                    id="userinput1" class="form-control border-primary" placeholder="Enter Page title"
                                                    name="title"
                                                    value="{{ old('title') }}" >
                                                @error('title')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1">content</label>

<textarea name="content" class="form-control border-primary" id="summernote">{{ old('content') }}</textarea>                                                @error('content')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>



                                    </div>


                                            <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="userinput1"> Image</label>
                                                <input type="file"
                                                    id="singlimage" class="form-control border-primary" placeholder="image"
                                                    name="image">
                                                @error('image')
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

                                    </div>
                                    <div>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Create
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
<script src="{{ asset('vendor/SummerNote/summernote-bs4.min.js') }}"></script>
<script>
    $(function(){
$('#summernote').summernote({
            placeholder: 'Write your Content here...',
            tabsize: 2,
            height: 150
        });
    });
</script>
@endpush

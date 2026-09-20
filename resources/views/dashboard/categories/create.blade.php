@extends('layout.dashboard.app')
@section('title')
    Create Category
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
                        <h4 class="card-title" id="basic-layout-colored-form-control">Create category</h4>
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
                            <form class="form" action="{{ route('dashboard.categories.store') }}"
                                method="post">
                                @csrf
                                    <h4 class="form-section"><i class="fas fa-pen"></i> Create Category</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> Name English</label>
                                                <input type="text"
                                                    id="userinput1" class="form-control border-primary" placeholder="Name"
                                                    name="name[en]"
                                                    value="{{ old('name[en]') }}" >
                                                @error('name.en')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> Name Arabic</label>
                                                <input type="text"
                                                    id="userinput1" class="form-control border-primary" value="{{ old('name[ar]') }}" placeholder="Name"
                                                    name="name[ar]">
                                                @error('name.ar')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">Status</label>
                                                <select class="form-control border-primary" name="status" id="">
                                                    <option value="" selected disabled>Select Status</option>

                                                    <option value="1">Active</option>
                                                    <option value="0">DisActive</option>
                                                </select>
                                                @error('status')
                                                    <div class="'text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">Parent</label>
                                                <select class="form-control border-primary" name="parent" id="">
                                                    <option value="" selected disabled>Select Parent</option>


                                                    @foreach ($categories as $parent)
                                                        <option value="{{ $parent->id }}">
                                                            {{ $parent->getTranslation('name', app()->getLocale()) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('parent')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> Category Icon</label>
                                                <input type="file"
                                                    id="singlimage" class="form-control border-primary" placeholder="icon"
                                                    name="icon">
                                                @error('icon')
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

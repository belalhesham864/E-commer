@extends('layout.dashboard.app')
@section('title')
    Edit Category
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
                        <h4 class="card-title" id="basic-layout-colored-form-control">Edit category</h4>
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
                            <form class="form" action="{{ route('dashboard.categories.update', $category->id) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-body">
                                    <h4 class="form-section"><i class="fas fa-pen"></i> Edit Category</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> Name English</label>
                                                <input type="text" value="{{ $category->getTranslation('name', 'en') }}"
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
                                                <input type="text" value="{{ $category->getTranslation('name', 'ar') }}"
                                                    id="userinput1" class="form-control border-primary" placeholder="Name"
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

                                                    <option @selected($category->status == 1) value="1">Active</option>
                                                    <option @selected($category->status == 0) value="0">DisActive</option>
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
                                                        <option value="{{ $parent->id }}" @selected($category->parent == $parent->id)>
                                                            {{ $parent->getTranslation('name', app()->getLocale()) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('parent')
                                                    <div class="text-danger">{{ $message }}</div>
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

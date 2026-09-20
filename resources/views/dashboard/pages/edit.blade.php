@extends('layout.dashboard.app')
@section('title')
    Edit Page
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
                        <h4 class="card-title" id="basic-layout-colored-form-control">Edit Page</h4>
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
                            <form class="form" action="{{ route('dashboard.pages.update',$page->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <h4 class="form-section"><i class="fas fa-pen"></i> Edit Page</h4>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="userinput1"> Title</label>
                                        <input type="text" id="userinput1" class="form-control border-primary"
                                            placeholder="Enter Page title" name="title" value="{{ $page->title }}">
                                        @error('title')
                                            <div class="'text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="userinput1">content</label>

                                        <textarea name="content" class="form-control border-primary" id="summernote">{{ old('content', $page->content) }}</textarea> @error('content')
                                            <div class="'text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>



                                </div>
                      <div class="col-md-12">
    <div class="form-group">
        <label for="status" class="font-weight-bold">
            Status
        </label>

    <select name="is_active" id="status" class="form-control border-primary">
        <option value="1" @selected($page->is_active == 'Active')>
            🟢 Active
        </option>

        <option value="0" @selected($page->is_active == 'DisActive')>
            🔴 DisActive
        </option>
    </select>

    @error('is_active')
        <div class="text-danger mt-1">
            {{ $message }}
        </div>
    @enderror
</div>

</div>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="userinput1"> Image</label>
                                        <input type="file" id="singlimage_edit" class="form-control border-primary"
                                            placeholder="image" name="image">
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
    <script src="{{ asset('vendor/SummerNote/summernote-bs4.min.js') }}"></script>
    <script>
        $(function() {
            $('#summernote').summernote({
                placeholder: 'Write your Content here...',
                tabsize: 2,
                height: 150,
            });
let imagePath = "{{ asset($page->image) }}";

$('#singlimage_edit').fileinput({
    theme: 'fa5',
    showCancel: true,
    maxFileCount: 1,
    showUpload: false,
    showRemove: true,
    enableResumableUpload: false,
    browseLabel: 'select image',
    initialPreviewAsData: true,
    @if($page->getRawOriginal('image'))
    initialPreview: [
        "{{ asset($page->image) }}"
    ],
    initialPreviewConfig: [{
        caption: '{{ $page->title }}',
        key: '{{ $page->id }}',
        url: "{{ route('dashboard.pages.deleteImage', $page->id) }}",
        extra: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
        }
    }],
    @endif
});

        });
    </script>
@endpush

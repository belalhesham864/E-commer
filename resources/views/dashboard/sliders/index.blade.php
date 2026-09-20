@extends('layout.dashboard.app')

@section('title')
    Sliders
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
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('words.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.roles.index') }}">{{ __('words.Roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create') }}">
                                        {{ __('words.Create Roles') }}
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


                    <div class="card-content collapse show">
                        <a style="margin-left:20px" class="btn btn-primary modal-effect" data-effect="effect-scale"
                            data-toggle="modal" href="#createSlider">

                            <i class="ft-plus mr-1"></i>Create Slider
                        </a>
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your Sliders from one place. You can add a new category, edit or update
                                existing ones, and remove Sliders you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>image</th>
                                        <th>Note</th>

                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>image</th>
                                        <th>Note</th>

                                        <th>Created_at</th>

                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            @include('dashboard.sliders.create')
                            @include('dashboard.sliders.edit')
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


@push('scripts')
    @if ($errors->any())
        <script>
            $(function() {
                $('#createSlider').modal('show');
            });
        </script>
    @endif


    <script>
        $(function() {
            $('#yajra_table').DataTable({
                processing: true,
                serverSide: true,


                ajax: "{{ route('dashboard.sliders.all') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'file_name',
                        name: 'file_name'


                    },
                    {
                        data: 'product_slug',
                        name: 'product_slug',
                        searchable: false,
                        orderable: false,

                    },



                    {
                        data: 'created_at',
                        name: 'created_at'

                    },
                    {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,

                    },

                ],
                layout: {
                    topStart: ['pageLength', 'buttons'],
                    topEnd: 'search',
                    bottomStart: 'info',
                    bottomEnd: 'paging'
                },
                buttons: ['colvis', 'print', 'copy', 'excel', 'pdf'],
            });
        });
    </script>
    <script>
        $(document).on('submit', '#createSlider2', function(e) {
            e.preventDefault();

            $('.error-text').text('');
            $('.form-control').removeClass('is-invalid');

            let data = new FormData(this);

            $.ajax({
                url: "{{ route('dashboard.sliders.store') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == true) {
                        $('#createSlider').modal('hide');
                        $('#createSlider2')[0].reset();
                        $('.error-text').text('');
                        $('.form-control').removeClass('is-invalid');

                        $('#yajra_table').DataTable().ajax.reload(null, false);
                        Swal.fire({
                            title: data.msg || "Slider Created Successfully",
                            icon: "success",
                            draggable: true
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                            $('[name="' + key + '"]').addClass('is-invalid');
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong, please try again.",
                            icon: "error"
                        });
                    }
                }
            });
        });

        $('#createSlider').on('hidden.bs.modal', function() {
            $('#createSlider2')[0].reset();
            $('.error-text').text('');
            $('.form-control').removeClass('is-invalid');
        });
    </script>
    <script>
        $(document).on('click','.delete_confirm_slider',function(e){
            e.preventDefault();
          let slider_id=$(this).attr('slider-id');
                  Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Delete the Slider ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete Slider!"
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ route('dashboard.sliders.destroy', ':id') }}".replace(':id', slider_id),
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#yajra_table').DataTable().ajax.reload(null, false);

                        Swal.fire({
                            title: "Slider Deleted Successfuly",
                            icon: "success",
                            draggable: true
                        });
                    },


                });

            }
        });
        });
    </script>
    <script>
        $(document).on('click', '.Edit_Slider', function(e) {
            e.preventDefault();
            let slider_id = $(this).attr('slider-id');

            $.ajax({
                url: "{{ route('dashboard.sliders.edit', ':id') }}".replace(':id', slider_id),
                type: "GET",
                success: function(data) {
                    if (data.status == true) {
                        $('#slider_id_edit').val(data.slider.id);
                        $('#product_slug_edit').val(data.slider.product_slug);
                        $('.error-text').text('');
                        $('.form-control').removeClass('is-invalid');

                        $('#singlimage_edit').fileinput('destroy');
                        let imagePath = "{{ asset('') }}" + data.slider.file_name;

                        $('#singlimage_edit').fileinput({
                            theme: 'fa5',
                            showCancel: true,
                            maxFileCount: 1,
                            showUpload: false,
                            showRemove: true,
                            enableResumableUpload: false,
                            browseLabel: 'select image',
                            initialPreviewAsData: true,
                            initialPreview: [
                                imagePath
                            ],
                            initialPreviewConfig: [
                                { caption: data.slider.product_slug || 'Slider Image' }
                            ]
                        });

                        $('#EditSlider').modal('show');
                    }
                },
            });
        });

        $(document).on('submit', '#EditSliderForm', function(e) {
            e.preventDefault();

            $('.error-text').text('');
            $('.form-control').removeClass('is-invalid');

            let slider_id = $('#slider_id_edit').val();
            let data = new FormData(this);
            data.append('_method', 'PUT');

            $.ajax({
                url: "{{ route('dashboard.sliders.update', ':id') }}".replace(':id', slider_id),
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == true) {
                        $('#EditSlider').modal('hide');
                        $('#yajra_table').DataTable().ajax.reload(null, false);
                        Swal.fire({
                            title: data.msg || "Slider Updated Successfully",
                            icon: "success",
                            draggable: true
                        });
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            $('#' + key + '_edit_error').text(value[0]);
                            $('[name="' + key + '"]', '#EditSliderForm').addClass('is-invalid');
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong, please try again.",
                            icon: "error"
                        });
                    }
                }
            });
        });

        $('#EditSlider').on('hidden.bs.modal', function() {
            $('#singlimage_edit').fileinput('destroy');
            $('#EditSliderForm')[0].reset();
            $('.error-text').text('');
            $('.form-control').removeClass('is-invalid');
        });
    </script>
@endpush

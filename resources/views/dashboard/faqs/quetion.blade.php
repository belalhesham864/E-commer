@extends('layout.dashboard.app')

@section('title')
    Faqs Question
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
                
                        <div class="card-body card-dashboard">
                            <p class="card-text">
                                Manage all your faq question from one place. You can add a new category, edit or update
                                existing ones, and remove faq question you no longer need. Use the search box to quickly
                                find a specific category, or export the list as Excel, PDF, or print it directly.
                            </p>
                            <table id="yajra_table" class="table table-striped table-bordered column-rendering">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>

                                        <th>Created_at</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Message</th>

                                        <th>Created_at</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                            </table>

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


                ajax: "{{ route('dashboard.faqs.question-all') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'name',
                        name: 'name'


                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: false,
                        orderable: false,

                    },
                    {
                        data: 'subject',
                        name: 'subject',
                        searchable: false,
                        orderable: false,

                    },
                    {
                        data: 'message',
                        name: 'message',
                        searchable: false,
                        orderable: false,

                    },



                    {
                        data: 'created_at',
                        name: 'created_at'

                    },
                    {
                        data: 'action',
                        name: 'action'

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
        $(document).on('click','.delete_confirm_faqQuetion',function(e){
            e.preventDefault();
          let faqQuetion_id=$(this).attr('faqQuetion-id');
                  Swal.fire({
            title: "Are you sure?",
            text: "Do you want to Delete the faqQuetion ",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Delete faqQuetion!"
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ route('dashboard.faq.question.delete', ':id') }}".replace(':id', faqQuetion_id),
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#yajra_table').DataTable().ajax.reload(null, false);

                        Swal.fire({
                            title: "faqQuetion Deleted Successfuly",
                            icon: "success",
                            draggable: true
                        });
                    },


                });

            }
        });
        });
    </script>

@endpush

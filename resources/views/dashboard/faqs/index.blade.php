@extends('layout.dashboard.app')

@section('title')
    Faqs
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
                        <a style="margin-left:20px" class="btn btn-primary round btn-glow px-2 modal-effect"
                            data-effect="effect-scale" data-toggle="modal" href="#createFaqs">

                            <i class="ft-plus mr-1"></i>Create Faqs
                        </a>
                        <div class="card-body card-dashboard">
                            <div class="col-xl-10 col-lg-11 mx-auto">
                                <div class="text-center mb-4">
                                    <h2 class="font-weight-bold text-primary">
                                        Frequently Asked Questions
                                    </h2>

                                    <p class="text-muted">
                                        Manage your FAQ list, edit answers, or remove outdated questions.
                                    </p>
                                </div>

                                <div id="faqAccordion">

                                    @forelse($faqs as $faq)
                                        <div class="card shadow-sm mb-2 border-0 rounded" id="faq_{{ $faq->id }}">
                                            <div class="card-header bg-white border-bottom" id="heading{{ $faq->id }}">
                                                <div class="d-flex justify-content-between align-items-center">

                                                    <a class="text-dark font-weight-bold flex-grow-1" data-toggle="collapse"
                                                        href="#collapse{{ $faq->id }}" aria-expanded="false">

                                                        <i class="ft-help-circle text-primary mr-50"></i>

                                                        <span id="question_{{ $faq->id }}">
                                                            {{ $faq->question }}
                                                        </span>

                                                    </a>

                                                    <div class="btn-group">

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary edit-btn"
                                                            faq-id="{{ $faq->id }}" title="Edit">
                                                            <i class="la la-edit"></i>
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger delete_confirm_btn"
                                                            faqs-id="{{ $faq->id }}" title="Delete">
                                                            <i class="la la-trash"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-outline-secondary"
                                                            data-toggle="collapse"
                                                            data-target="#collapse{{ $faq->id }}">
                                                            <i class="ft-chevron-down"></i>
                                                        </button>

                                                    </div>

                                                </div>
                                            </div>

                                            <div id="collapse{{ $faq->id }}" class="collapse"
                                                data-parent="#faqAccordion">

                                                <div class="card-body bg-light">

                                                    <p class="mb-0 text-muted" id="answer_{{ $faq->id }}">
                                                        {{ $faq->answer }}
                                                    </p>

                                                </div>

                                            </div>

                                        </div>

                                    @empty

                                        <div class="alert alert-info text-center">
                                            No FAQs Found.
                                        </div>
                                    @endforelse

                                </div>

                            </div>
                        </div>
                        @include('dashboard.faqs.create')
                        @include('dashboard.faqs.edit')
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('asset/dashboard') }}/vendors/js/extensions/dragula.min.js" type="text/javascript"></script>
    <script src="{{ asset('asset/dashboard') }}/js/scripts/extensions/drag-drop.js" type="text/javascript"></script>
    <script>
        $(document).on('click', '.edit-btn', function(e) {
            e.preventDefault();
            var id = $(this).attr('faq-id');
            $.ajax({
                url: "{{ route('dashboard.faqs.edit', ':id') }}".replace(':id', id),
                type: "GET",
                success: function(data) {
                    if (data.status == true) {
                        $('#edit_question').val(data.faqs.question);
                        $('#edit_answer').val(data.faqs.answer);
                        $('#edit_faqs_id').val(data.faqs.id);

                        $('#editFaqs').modal('show');
                    }
                }

            });
        });
    </script>
    <script>
        $(document).on('submit', '#edit_faqs', function(e) {
            e.preventDefault();
            $('#edit_error_list').empty();
            $('#edit_alert_div').hide();
            var id = $('#edit_faqs_id').val();
            var data = new FormData(this);
            data.append('_method', 'PUT');

            $.ajax({
                url: "{{ route('dashboard.faqs.update', ':id') }}".replace(':id', id),
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == true) {
                        $('#edit_error_list').empty();
                        $('#edit_alert_div').hide();
                        $('#editFaqs').modal('hide');
                        $('#question_' + data.faqs.id).text(data.faqs.question);
                        $('#answer_' + data.faqs.id).text(data.faqs.answer);
                        Swal.fire({
                            title: data.msg,
                            icon: "success"
                        });
                    }
                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#edit_error_list').append(`<li>` + value[0] + `</li>`);
                            $('#edit_alert_div').show();

                        });
                    }
                }

            });
        });
    </script>
    <script>
        $(document).on('click', '.delete_confirm_btn', function(e) {
            e.preventDefault();
            var id = $(this).attr('faqs-id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed)
                    $.ajax({
                        url: "{{ route('dashboard.faqs.destroy', ':id') }}".replace(':id', id),
                        type: "DELETE",
                        data: {
                            '_token': "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            $('#faq_' + id).remove();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your FAQS has been deleted.",
                                icon: "success"
                            });
                        }
                    });
            });
        });
    </script>
    <script>
        $(document).on('submit', '#create_faqs', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                url: "{{ route('dashboard.faqs.store') }}",
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status == true) {
                        $('#error_list').empty();

                        $('#alert_div').hide();
                        $('#create_faqs')[0].reset();
                        $('#createFaqs').modal('hide');
                       $("#faqAccordion").prepend(`
                           <div class="card shadow-sm mb-2 border-0 rounded" id="faq_${data.faqs.id}">
                                            <div class="card-header bg-white border-bottom" id="heading${data.faqs.id}">
                                                <div class="d-flex justify-content-between align-items-center">

                                                    <a class="text-dark font-weight-bold flex-grow-1" data-toggle="collapse"
                                                        href="#collapse${data.faqs.id}" aria-expanded="false">

                                                        <i class="ft-help-circle text-primary mr-50"></i>

                                                        <span id="question_${data.faqs.id}">
                                                            ${data.faqs.question}
                                                        </span>

                                                    </a>

                                                    <div class="btn-group">

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-primary edit-btn"
                                                            faq-id="${data.faqs.id}" title="Edit">
                                                            <i class="la la-edit"></i>
                                                        </button>

                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-danger delete_confirm_btn"
                                                            faqs-id="${data.faqs.id}" title="Delete">
                                                            <i class="la la-trash"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-outline-secondary"
                                                            data-toggle="collapse"
                                                            data-target="#collapse${data.faqs.id}">
                                                            <i class="ft-chevron-down"></i>
                                                        </button>

                                                    </div>

                                                </div>
                                            </div>

                                            <div id="collapse${data.faqs.id}" class="collapse"
                                                data-parent="#faqAccordion">

                                                <div class="card-body bg-light">

                                                    <p class="mb-0 text-muted" id="answer_${data.faqs.id}">
                                                        ${data.faqs.answer}
                                                    </p>

                                                </div>

                                            </div>

                                        </div>

                       `);
                        Swal.fire({
                            title: "FAQS Created Successfuly",
                            icon: "success",
                            draggable: true
                        });
                    } else {
                        Swal.fire({
                            title: data.error,
                            icon: "error",
                            draggable: true
                        });
                    }

                },
                error: function(data) {
                    if (data.responseJSON.errors) {
                        $.each(data.responseJSON.errors, function(key, value) {
                            $('#error_list').append(`<li>` + value[0] + `</li>`);
                            $('#alert_div').show();
                        });
                    }
                }
            });
        });
    </script>
@endpush

@extends('layout.dashboard.app')

@section('title')
    Contacts
@endsection

@push('css')

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/dashboard/css/pages/email-application.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/dashboard/custom/contacts.css') }}">
@endpush

@section('body')
    <div class="app-content content email-application">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content email-app-sidebar d-flex">
                    {{-- Side Bar --}}

                    @livewire('dashboard.contact.contact-sidebar')

                    {{-- Contect Mseeage --}}

                    @livewire('dashboard.contact.contact-message')
                </div>
            </div>
        </div>



        {{-- Contect Show --}}

        <div class="content-right">
            @livewire('dashboard.contact.contact-details')
        </div>

        {{-- Replay Contact Modal Component --}}
        @livewire('dashboard.contact.replay-contact')
    </div>
@endsection

@push('scripts')
    <script>
        document.body.classList.add('email-application', 'content-left-sidebar');
    </script>
    <script src="{{ asset('asset/dashboard/js/scripts/pages/email-application.js') }}" type="text/javascript"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('delete-message', (event) => {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Message Deleted Successfully",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('replay-message-component-modal', (event) => {

                $('#replayContactModal').modal('show');
            });
            Livewire.on('close-modal', (event) => {

                $('#replayContactModal').modal('hide');
            });
            Livewire.on('replay-success', (event) => {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Replay Send Successfully",
                    showConfirmButton: false,
                    timer: 2000
                });

            });
            Livewire.on('replay-fail', (event) => {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error In Send Please Try Again Latter",
                    showConfirmButton: false,
                    timer: 2000
                });

            });
            Livewire.on('archive-message', (event) => {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Message Archived Successfully",
                    showConfirmButton: false,
                    timer: 2000
                });

            });
            Livewire.on('restore-message', (event) => {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Message Restore Successfully",
                    showConfirmButton: false,
                    timer: 2000
                });

            });
        });
    </script>

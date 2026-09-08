@extends('layout.dashboard.app')

@section('title')
    Products
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
                @livewire('dashboard.edit-product',['categories'=>$categories,'brands'=>$brands,'product_attributes'=>$product_attributes,'id'=>$id])

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('asset/dashboard/custom/product.css') }}">

@endpush
@push('scripts')
<script>
    document.addEventListener('livewire:init', () => {

        Livewire.on('product-updated', () => {

            Swal.fire({
                position: "center",
                icon: "success",
                title: "Product Updated Successfully",
                showConfirmButton: false,
                timer: 1500
            });

        });

    });
</script>

@extends('layout.website.app')
@section('title', 'Shop')

@push('css')
    <link rel="stylesheet" href="{{ asset('asset/website/css/pagiation.css') }}">
@endpush

@section('body')
    <section class="product product-sidebar footer-padding">
        <div class="container">
            @livewire('website.shop.shop-page')
        </div>
    </section>
@endsection

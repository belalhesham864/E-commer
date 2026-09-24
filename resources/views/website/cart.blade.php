@extends('layout.website.app')
@section('title','Cart')
@section('body')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{  route('Home.index')}}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">Cart</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Cart</h1>
            </div>
        </div>
    </section>


    <section class="product-cart product footer-padding">
     @livewire('website.cart.cart')
    </section>
@endsection

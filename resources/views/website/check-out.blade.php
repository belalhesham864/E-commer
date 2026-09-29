@extends('layout.website.app')
@section('title','Check-Out')
@section('body')
<section class="blog about-blog">
<div class="container">
<div class="blog-bradcrum">
<span><a href="{{ route('Home.index') }}">Home</a></span>
<span class="devider">/</span>
<span><a href="#">Checkout</a></span>
</div>
<div class="blog-heading about-heading">
<h1 class="heading">Checkout</h1>
</div>
</div>
</section>


<section class="checkout product footer-padding">
<div class="container">
<div class="checkout-section">
<div class="row gy-5">
<div class="col-lg-6">
@livewire('website.checkout.shipping-details')
</div>
<div class="col-lg-6">
@livewire('website.checkout.order-details')
</div>
</div>
</div>
</div>
</section>

@endsection

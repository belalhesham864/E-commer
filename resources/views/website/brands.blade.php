@extends('layout.website.app')
@section('title','Brands')
@section('body')



<section class="blog about-blog">
<div class="container">
<div class="blog-bradcrum">
<span><a href="{{ route('Home.index') }}">Home</a></span>
<span class="devider">/</span>
<span><a href="javascript:void(0)">Brands</a></span>
</div>

</div>
</section>

{{-- Brands Section --}}
<section class="product brand" data-aos="fade-up">
<div style="margin-bottom: 65px" class="container">
<div class="section-title">
<h5>Brand of Prodcuts</h5>
</div>
<div  class="brand-section">
@foreach ($brands as $brand )
<div style="margin: 6px" class="product-wrapper">
<div class="wrapper-img">
<a href="{{ route('brands.product',$brand->slug) }}">
<img src="{{ asset($brand->logo) }}" alt="img">
</a>
</div>
</div>


@endforeach
</div>
</div>
</section>


@endsection

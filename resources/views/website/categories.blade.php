@extends('layout.website.app')
@section('title','Categories')
@section('body')

<section class="blog about-blog">
<div class="container">
<div class="blog-bradcrum">
<span><a href="{{ route('Home.index') }}">Home</a></span>
<span class="devider">/</span>
<span><a href="javascript:void(0)">Categories</a></span>
</div>

</div>
</section>



{{-- Categories Section --}}
<section  class="product-category" >
<div style="margin-bottom: 80px" class="container">
<div class="section-title">
<h5>Our Categories</h5>
</div>
<div  class="category-section">

@foreach ($categories as $category )
<div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
<div class="wrapper-img">
<img src="{{ asset($category->icon) }}" alt="dress">
</div>
<div class="wrapper-info">
<a href="{{ route('categories.product',$category->slug) }}" class="wrapper-details">{{ $category->name }}</a>
</div>
</div>

@endforeach

</div>
</div>
</section>
<br>
<br>
<br>

@endsection

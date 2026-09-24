@extends('layout.website.app')
@section('title', "$product->name")
@section('body')
    <section class="product product-info">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('Home.index') }}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="{{ route('shop') }}">Shop</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">{{ $product->name }}</a></span>
            </div>
            <div class="product-info-section">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="product-info-img" data-aos="fade-right">
                            <div class="swiper product-top">
                                <div class="product-discount-content" style="position:absolute; top:15px; left:15px; z-index:10;">
                                    <h4>-50%</h4>
                                </div>
                                <div class="swiper-wrapper">
                                    @foreach ($product->images as $img)
                                        <div class="swiper-slide slider-top-img">
                                            <img src="{{ asset($img->file_name) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="swiper product-bottom">
                                <div class="swiper-wrapper">
                                    @foreach ($product->images as $img)
                                        <div class="swiper-slide slider-bottom-img">
                                            <img src="{{ asset($img->file_name) }}" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        @livewire('website.product-details',['product'=>$product])
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product product-description">
        <div class="container">
            <div class="product-detail-section">
                <nav>
                    <div class="nav nav-tabs nav-item" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Description</button>
                        <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review"
                            type="button" role="tab" aria-controls="nav-review"
                            aria-selected="false">Reviews</button>

                    </div>
                </nav>
                <div class="tab-content tab-item" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0" data-aos="fade-up">
                        <div class="product-intro-section">
                            {{ $product->small_desc }}
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab"
                        tabindex="0">
                        <div class="product-review-section" data-aos="fade-up">
                            <h5 class="intro-heading">Reviews</h5>
                            <div class="review-wrapper">
                                @forelse ($product->productReviews as $reiview)
                                    <div class="wrapper">
                                        <div class="wrapper-aurthor">
                                            <div class="wrapper-info">
                                                <div class="aurthor-img">

                                                    @if ($reiview->user->image)
                                                        <img src="{{ asset('uploads/users/' . $reiview->user->image) }}"
                                                            width="50" height="50" class="rounded-circle">
                                                    @else
                                                        <img src="{{ asset('asset/dashboard/images/users/user.jfif') }}"
                                                            width="50" height="50" class="rounded-circle">
                                                    @endif

                                                </div>
                                                <div class="author-details">
                                                    <h5>{{ $reiview->user->name }}</h5>
                                                    <p>{{ $reiview->user->country->name }},{{ $reiview->user->city->name }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="ratings">
                                                <span>
                                                    <svg width="75" height="15" viewBox="0 0 75 15"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                            fill="#FFA800" />
                                                        <path
                                                            d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                            fill="#FFA800" />
                                                        <path
                                                            d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                            fill="#FFA800" />
                                                        <path
                                                            d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                            fill="#FFA800" />
                                                        <path
                                                            d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                            fill="#FFA800" />
                                                    </svg>
                                                </span>
                                                <span>(5.0)</span>
                                            </div>
                                        </div>
                                        <div class="wrapper-description">
                                            <p class="wrapper-details">{{ $reiview->comment }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <div class="cart-content text-center py-5">
                                        <div class="cart-img mb-3">
                                            <img src="{{ asset('asset/website/assets/images/homepage-one/empty-wishlist.webp') }}"
                                                alt="No Reviews" style="max-width: 140px;">
                                        </div>
                                        <p class="content-title"
                                            style="font-size: 1.8rem; font-weight: 600; color: #232532;">
                                            No Reviews Yet!
                                        </p>
                                        <span style="color: #797979; font-size: 1.4rem;">
                                            Be the first to review this product.
                                        </span>
                                    </div>
                                @endforelse


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product weekly-sale product-weekly footer-padding">
        <div class="container">
            <div class="section-title">
                <h5>Related Product</h5>
                <a href="{{ route('product.related', $product->slug) }}" class="view">View All</a>
            </div>
            <div class="weekly-sale-section">
                <div class="row g-5">
                    @foreach ($relatedProduct as $item)
                        <div class="col-lg-3 col-md-6">

                            <div class="product-wrapper" data-aos="fade-up">
                                <div class="product-img">
                                    <img src="{{ asset($item->images->first()->file_name) }}" alt="{{ $item->name }}">
                                    <div class="position-absolute top-0 start-0 text-white fw-semibold py-1 px-3 m-3 rounded-pill shadow-sm"
                                        style="background-color: #ae1c9a; font-size: 0.75rem; letter-spacing: 0.5px;">
                                        {{ $item->brand->name }}
                                    </div>
                                    <div class="product-cart-items">
                                        <a href="{{ route('product.show', $item->slug) }}" class="cart cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20" fill="white" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M12 14.4482V16.5664H12.5466H13.0933V15.3957V14.2204L15.6214 16.7486L18.1496 19.2767L18.5459 18.8759L18.9468 18.4796L16.4186 15.9514L13.8904 13.4232H15.0657H16.2364V12.8766V12.33H14.1182H12V14.4482Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M23.4345 12.8766V13.4232H24.6052H25.7805L23.2523 15.9514L20.7241 18.4796L21.125 18.8759L21.5213 19.2767L24.0495 16.7486L26.5776 14.2204V15.3957V16.5664H27.1243H27.6709V14.4482V12.33H25.5527H23.4345V12.8766Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M15.6078 23.5905L13.0933 26.1096V24.9343V23.7636H12.5466H12V25.8818V28H14.1182H16.2364V27.4534V26.9067H15.0657H13.8904L16.4186 24.3786L18.9468 21.8504L18.5596 21.4632C18.35 21.2491 18.1633 21.076 18.1496 21.076C18.1359 21.076 16.9926 22.2103 15.6078 23.5905Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M21.1113 21.4632L20.7241 21.8504L23.2523 24.3786L25.7805 26.9067H24.6052H23.4345V27.4534V28H25.5527H27.6709V25.8818V23.7636H27.1243H26.5776V24.9343V26.1096L24.0586 23.5905C22.6783 22.2103 21.535 21.076 21.5213 21.076C21.5076 21.076 21.3209 21.2491 21.1113 21.4632Z"
                                                        fill="black" fill-opacity="0.2" />
                                                </svg>
                                            </span>
                                        </a>
                                                                  @livewire('website.wishlist.wishlist',['product'=>$item,'type'=>'card'],key('wishlist-'.$item->id));

                                        <a href="compaire.html" class="compaire cart-item">
                                            <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20" fill="white" />
                                                    <path
                                                        d="M18.8948 10.6751C18.8948 11.0444 18.8829 11.3502 18.871 11.3502C18.8591 11.3502 18.6645 11.3859 18.4461 11.4336C14.674 12.1959 11.8588 15.1779 11.3346 18.966C11.2115 19.8316 11.2632 21.1499 11.4498 22.0314C11.9223 24.2867 13.3875 26.4031 15.3252 27.642L15.5515 27.7849L16.1114 27.364C16.4171 27.1337 16.6712 26.9352 16.6712 26.9193C16.6712 26.9074 16.572 26.8439 16.4529 26.7803C15.8453 26.4627 15.0552 25.8274 14.5191 25.2278C13.5026 24.0882 12.8514 22.6984 12.641 21.2372C12.5655 20.6972 12.5655 19.6251 12.641 19.1129C12.8038 18.0289 13.185 17.0044 13.7568 16.1071C14.4715 14.9913 15.5594 14.0145 16.7507 13.4149C17.3542 13.1132 18.192 12.8273 18.7678 12.724L18.8948 12.7002V13.2561C18.8948 13.5618 18.9028 13.812 18.9147 13.812C18.9544 13.812 21.4361 11.9339 21.4361 11.9061C21.4361 11.8783 18.9544 10.0001 18.9147 10.0001C18.9028 10.0001 18.8948 10.3019 18.8948 10.6751Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M18.8948 10.6751C18.8948 11.0444 18.8829 11.3502 18.871 11.3502C18.8591 11.3502 18.6645 11.3859 18.4461 11.4336C14.674 12.1959 11.8588 15.1779 11.3346 18.966C11.2115 19.8316 11.2632 21.1499 11.4498 22.0314C11.9223 24.2867 13.3875 26.4031 15.3252 27.642L15.5515 27.7849L16.1114 27.364C16.4171 27.1337 16.6712 26.9352 16.6712 26.9193C16.6712 26.9074 16.572 26.8439 16.4529 26.7803C15.8453 26.4627 15.0552 25.8274 14.5191 25.2278C13.5026 24.0882 12.8514 22.6984 12.641 21.2372C12.5655 20.6972 12.5655 19.6251 12.641 19.1129C12.8038 18.0289 13.185 17.0044 13.7568 16.1071C14.4715 14.9913 15.5594 14.0145 16.7507 13.4149C17.3542 13.1132 18.192 12.8273 18.7678 12.724L18.8948 12.7002V13.2561C18.8948 13.5618 18.9028 13.812 18.9147 13.812C18.9544 13.812 21.4361 11.9339 21.4361 11.9061C21.4361 11.8783 18.9544 10.0001 18.9147 10.0001C18.9028 10.0001 18.8948 10.3019 18.8948 10.6751Z"
                                                        fill="black" fill-opacity="0.2" />
                                                    <path
                                                        d="M24.219 12.9662C23.9133 13.1965 23.6671 13.399 23.679 13.4149C23.6909 13.4347 23.81 13.5102 23.949 13.5856C25.1124 14.2448 26.1964 15.3566 26.8675 16.5914C27.2725 17.334 27.614 18.414 27.7092 19.2558C27.7887 19.9189 27.741 21.0585 27.614 21.662C27.066 24.2589 25.2593 26.3514 22.7657 27.2806C22.452 27.3957 21.6023 27.63 21.4911 27.63C21.4474 27.63 21.4355 27.5307 21.4355 27.0741C21.4355 26.7684 21.4276 26.5182 21.4157 26.5182C21.376 26.5182 18.8943 28.3963 18.8943 28.4241C18.8943 28.4519 21.376 30.3301 21.4157 30.3301C21.4276 30.3301 21.4355 30.0283 21.4355 29.6551V28.984L21.5864 28.9602C21.9557 28.9006 23 28.6187 23.3415 28.4837C26.4386 27.2726 28.559 24.5884 28.9997 21.3166C29.1149 20.4748 29.0633 19.1565 28.8806 18.2988C28.4081 16.0435 26.9429 13.9271 25.0052 12.6882L24.7789 12.5453L24.219 12.9662Z"
                                                        fill="#181818" />
                                                    <path
                                                        d="M24.219 12.9662C23.9133 13.1965 23.6671 13.399 23.679 13.4149C23.6909 13.4347 23.81 13.5102 23.949 13.5856C25.1124 14.2448 26.1964 15.3566 26.8675 16.5914C27.2725 17.334 27.614 18.414 27.7092 19.2558C27.7887 19.9189 27.741 21.0585 27.614 21.662C27.066 24.2589 25.2593 26.3514 22.7657 27.2806C22.452 27.3957 21.6023 27.63 21.4911 27.63C21.4474 27.63 21.4355 27.5307 21.4355 27.0741C21.4355 26.7684 21.4276 26.5182 21.4157 26.5182C21.376 26.5182 18.8943 28.3963 18.8943 28.4241C18.8943 28.4519 21.376 30.3301 21.4157 30.3301C21.4276 30.3301 21.4355 30.0283 21.4355 29.6551V28.984L21.5864 28.9602C21.9557 28.9006 23 28.6187 23.3415 28.4837C26.4386 27.2726 28.559 24.5884 28.9997 21.3166C29.1149 20.4748 29.0633 19.1565 28.8806 18.2988C28.4081 16.0435 26.9429 13.9271 25.0052 12.6882L24.7789 12.5453L24.219 12.9662Z"
                                                        fill="black" fill-opacity="0.2" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="ratings">
                                        <span>
                                            <svg width="75" height="15" viewBox="0 0 75 15" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z"
                                                    fill="#FFA800" />
                                                <path
                                                    d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z"
                                                    fill="#FFA800" />
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="product-description">
                                        <a href="{{ route('product.show', $item->slug) }}"
                                            class="product-details">{{ $item->name }}
                                        </a>
                                        <div class="price">
                                            @if ($item->has_variants == 0)
                                                <span class="price-cut">{{ $item->price }}EGP</span>
                                                <span class="new-price">{{ $item->getPriceAfterDiscount() }}EGP</span>
                                            @else
                                                <span class="new-price">Has Variants</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="product-cart-btn">
                                    <a href="{{ route('categories.product', $product->category->slug) }}"
                                        class="product-btn">{{ $item->category->name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach





                </div>
            </div>
    </section>
@endsection

<div>
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="index-2.html">Home</a></span>
                <span class="devider">/</span>
                <span><a href="#">Wishlist</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">Wishlist</h1>
            </div>
        </div>
    </section>

  @if($wishlists->isNotEmpty())
    <section class="cart product wishlist footer-padding" >
        <div class="container">
            <div class="cart-section wishlist-section">
                <table>
                    <tbody>
                        <tr class="table-row table-top-row">
                            <td class="table-wrapper wrapper-product">
                                <h5 class="table-heading">PRODUCT</h5>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">PRICE</h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <h5 class="table-heading">ACTION</h5>
                                </div>
                            </td>
                        </tr>
                        @foreach($wishlists as $wishlist)


                            <tr class="table-row ticket-row">
                                <td class="table-wrapper wrapper-product">
                                    <div class="wrapper">
                                        <div class="wrapper-img">
                                            <img src="{{ asset($wishlist->product->images->first()->file_name) }}"
                                                alt="img" />
                                        </div>
                                    <a href="{{ route('product.show',$wishlist->product->slug) }}">
                                            <div class="wrapper-content">
                                            <h5 class="heading">{{ $wishlist->product->name }}</h5>
                                        </div>
                                    </a>
                                    </div>
                                </td>
                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                        <h5 class="heading">
                                            @if ($wishlist->product->has_variants == 0)
                                                @if ($wishlist->product->has_discount == 1)
                                                    <span class="price-cut">{{ $wishlist->product->price }}EGP</span>
                                                    <spaN class="new-price">{{ $wishlist->product->getPriceAfterDiscount() }}EGP</span>
                                                @else
                                                    <span class="new-price">{{ $wishlist->product->price }}EGP</span>
                                                @endif
                                            @else
                                                <span class="new-price">Has Variants</span>
                                            @endif
                                        </h5>
                                    </div>
                                </td>

                                <td class="table-wrapper">
                                    <div class="table-wrapper-center">
                                      <a wire:click="remove({{ $wishlist->product->id }})" href="javascript:void(0)">
                                          <span>
                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                    fill="#AAAAAA"></path>
                                            </svg>
                                        </span>
                                      </a>
                                    </div>
                                </td>
                            </tr>
                    @endforeach



                    </tbody>
                </table>
            </div>
            <div class="wishlist-btn">
                <a href="javascript:void(0)" @disabled($wishlists->isEmpty()) wire:click="removeAll()" class="clean-btn">Clean Wishlist</a>
                <a href="#" class="shop-btn">View Cards</a>
            </div>
        </div>
    </section>
  @else
  <section class="blog about-blog footer-padding">

<div class="blog-item" >
<div class="cart-img">
<img src="{{ asset('asset/website/assets/images/homepage-one/empty-wishlist.webp') }}" alt>
</div>
<div class="cart-content">
<p class="content-title">Empty! You don’t have any products in your wishlist </p>
<a href="{{ route('Home.index') }}" class="shop-btn">Back to Shop</a>
</div>
</div>
</div>
</section>

  @endif
</div>

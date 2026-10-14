<div>
    <div class="product-review-section">
        <h5 class="intro-heading">Reviews ({{ $reviews->count() }})</h5>

        <!-- Add Review Form -->
        <div class="review-form-wrapper mb-5 p-4 rounded-3" style="background-color: #f9f9fa; border: 1px solid #ebebeb;">
            <h5 class="comment-title mb-2" style="font-size: 1.25rem; font-weight: 600; color: #232532;">Write a Review</h5>
            <p class="text-muted small mb-3">Share your experience with this product to help others make better decisions.</p>

            @auth
                <form wire:submit.prevent="addReview">
                    <div class="review-textarea mb-3">
                        <label for="reviewComment" class="form-label fw-semibold" style="font-size: 0.95rem;">Your Review <span class="text-danger">*</span></label>
                        <textarea 
                            wire:model.live="comment" 
                            id="reviewComment" 
                            class="form-control @error('comment') is-invalid @enderror" 
                            rows="4" 
                            placeholder="Write your review here..."></textarea>
                        @error('comment')
                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="login-btn">
                        <button type="submit" class="shop-btn" wire:loading.attr="disabled">
                            <span wire:loading.remove>Submit Review</span>
                            <span wire:loading>
                                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                                Submitting...
                            </span>
                        </button>
                    </div>
                </form>
            @else
                <div class="alert alert-light border d-flex flex-column flex-sm-row justify-content-between align-items-sm-center p-3 mb-0" style="background: #ffffff; border-radius: 8px;">
                    <div class="mb-2 mb-sm-0">
                        <span class="text-muted">You must be logged in to leave a review.</span>
                    </div>
                    <a href="{{ route('login') }}" class="shop-btn" style="padding: 8px 20px; font-size: 0.9rem; text-decoration: none;">Login Now</a>
                </div>
            @endauth
        </div>

        <!-- Reviews List -->
        <div class="review-wrapper">
            @forelse ($reviews as $reiview)
                <div class="wrapper mb-4">
                    <div class="wrapper-aurthor">
                        <div class="wrapper-info">
                            <div class="aurthor-img">
                                @if ($reiview->user?->image)
                                    <img src="{{ asset('uploads/users/' . $reiview->user->image) }}"
                                        width="50" height="50" class="rounded-circle" style="object-fit: cover;">
                                @else
                                    <img src="{{ asset('asset/dashboard/images/users/user.jfif') }}"
                                        width="50" height="50" class="rounded-circle" style="object-fit: cover;">
                                @endif
                            </div>
                            <div class="author-details">
                                <h5>{{ $reiview->user?->name ?? 'User' }}</h5>
                                <p>
                                    @if ($reiview->user?->country || $reiview->user?->city)
                                        {{ $reiview->user?->country?->name }}{{ $reiview->user?->country && $reiview->user?->city ? ', ' : '' }}{{ $reiview->user?->city?->name }}
                                    @else
                                        Customer
                                    @endif
                                    <span class="text-muted ms-2" style="font-size: 0.8rem;">
                                        {{ $reiview->created_at ? $reiview->created_at->diffForHumans() : '' }}
                                    </span>
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
                        <p class="wrapper-details">{{ $reiview->comment }}</p>
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
                        Be the first to review this product above.
                    </span>
                </div>
            @endforelse
        </div>
    </div>
</div>

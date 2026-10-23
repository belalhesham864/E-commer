<div>
    @if ($screen == 'Reiview')
        <div class="tab-pane fade show active">
            <div class="dashboard-reviews-section">

                {{-- Reviews Grid --}}
                <div class="row g-4">
                    @if ($reiviews->count() > 0)
                        @foreach ($reiviews as $reiview)
                            <div class="col-lg-6 col-12">
                                <div class="review-dashboard-card">
                                    {{-- Product Image --}}
                                    <div class="review-card-img">
                                        @php
                                            $productImage = $reiview->product?->images?->first()?->file_name;
                                        @endphp
                                        <img src="{{ $productImage ? asset($productImage) : asset('asset/website/assets/images/homepage-one/product-img/product-img-1.webp') }}"
                                             alt="{{ $reiview->product?->name ?? 'Product' }}">
                                    </div>

                                    {{-- Product & Review Details --}}
                                    <div class="review-card-content">
                                        <div>
                                            {{-- Top Meta: Date & Stars --}}
                                            <div class="review-header-meta">
                                                <div class="review-date-badge">
                                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <polyline points="12 6 12 12 16 14"></polyline>
                                                    </svg>
                                                    <span>{{ $reiview->created_at?->diffForHumans() }}</span>
                                                </div>

                                                {{-- 5 Stars Rating --}}
                                                <div class="ratings d-flex align-items-center">
                                                    <span>
                                                        <svg width="75" height="15" viewBox="0 0 75 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z" fill="#FFA800" />
                                                            <path d="M22.5 0L24.1839 5.18237H29.6329L25.2245 8.38525L26.9084 13.5676L22.5 10.3647L18.0916 13.5676L19.7755 8.38525L15.3671 5.18237H20.8161L22.5 0Z" fill="#FFA800" />
                                                            <path d="M37.5 0L39.1839 5.18237H44.6329L40.2245 8.38525L41.9084 13.5676L37.5 10.3647L33.0916 13.5676L34.7755 8.38525L30.3671 5.18237H35.8161L37.5 0Z" fill="#FFA800" />
                                                            <path d="M52.5 0L54.1839 5.18237H59.6329L55.2245 8.38525L56.9084 13.5676L52.5 10.3647L48.0916 13.5676L49.7755 8.38525L45.3671 5.18237H50.8161L52.5 0Z" fill="#FFA800" />
                                                            <path d="M67.5 0L69.1839 5.18237H74.6329L70.2245 8.38525L71.9084 13.5676L67.5 10.3647L63.0916 13.5676L64.7755 8.38525L60.3671 5.18237H65.8161L67.5 0Z" fill="#FFA800" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- Product Title --}}
                                            @if ($reiview->product)
                                                <a href="{{ route('product.show', $reiview->product->slug) }}" class="review-product-name" title="{{ $reiview->product->name }}">
                                                    {{ $reiview->product->name }}
                                                </a>
                                            @else
                                                <span class="review-product-name text-muted">Product Unavailable</span>
                                            @endif

                                            {{-- Review Comment --}}
                                            <p class="review-comment-text" title="{{ $reiview->comment }}">
                                                "{{ Str::limit($reiview->comment, 85, '...') }}"
                                            </p>
                                        </div>

                                        {{-- Actions --}}
                                        <div class="review-card-actions">
                                            <button type="button" wire:click="editReview({{ $reiview->id }})" class="review-action-btn review-btn-edit">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M12 20h9"></path>
                                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                                </svg>
                                                <span>Edit Review</span>
                                            </button>

                                            <button type="button" data-id="{{ $reiview->id }}" class="review-action-btn review-btn-delete delete_reiview">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                </svg>
                                                <span>Delete Review</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12">
                            {{ $reiviews->links('livewire.website.pagination') }}
                        </div>
                    @else
                        <div class="col-12">
                            <div class="text-center py-5 bg-white rounded-3 border" style="border-color: #ebebeb !important;">
                                <div class="mb-3">
                                    <svg width="55" height="55" viewBox="0 0 24 24" fill="none" stroke="#ae1c9a" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.85;">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                </div>
                                <h5 class="fw-semibold mb-1" style="font-size: 1.25rem; color: #232532;">No Reviews Yet</h5>
                                <p class="text-muted small mb-0">You haven't submitted any product reviews yet.</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Edit Review Modal --}}
                @if ($showEditModal)
                    <div class="review-modal-backdrop" wire:click.self="closeEditModal">
                        <div class="review-modal-content">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="m-0 fw-semibold" style="font-size: 1.15rem; color: #232532;">Edit Your Review</h5>
                                <button type="button" wire:click="closeEditModal" class="btn-close" aria-label="Close"></button>
                            </div>

                            <form wire:submit.prevent="updateReview">
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold text-secondary">Review Comment</label>
                                    <textarea wire:model="editComment" class="form-control @error('editComment') is-invalid @enderror" rows="4" placeholder="Update your review..."></textarea>
                                    @error('editComment')
                                        <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" wire:click="closeEditModal" class="btn btn-sm btn-light border px-3">Cancel</button>
                                    <button type="submit" class="btn btn-sm text-white px-3" style="background-color: #ae1c9a;" wire:loading.attr="disabled">
                                        <span wire:loading.remove>Save Changes</span>
                                        <span wire:loading>Saving...</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    @endif

    {{-- Exact CSS matching category products page --}}
    <link rel="stylesheet" href="{{ asset('asset/website/css/pagiation.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/website/css/reiview.css') }}">
</div>

@script
<script>
    $(document).on('click', '.delete_reiview', function(e) {
        e.preventDefault();
        let reiviewId = $(this).attr('data-id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this review deletion!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ae1c9a",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.deleteReview(reiviewId);
            }
        });
    });
</script>
@endscript

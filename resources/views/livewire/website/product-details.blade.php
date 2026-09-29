      <div>
          <div class="product-info-content">
              <span class="wrapper-subtitle">{{ $product->category->name }}</span>
              <h5>{{ $product->name }}
              </h5>
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
                  <span class="text">{{ $product->productReviews->count() }} review</span>
              </div>
              {{-- Price --}}
              <div class="price">
                  @if ($product->has_variants == 0)
                      @if ($product->has_discount)
                          <span class="price-cut">{{ $product->price }}</span>
                          <span class="new-price">{{ $product->getPriceAfterDiscount() }}</span>
                      @else
                          <span class="new-price">{{ $product->price }}</span>
                      @endif
                  @else
                      <span class="new-price">{{ $price ?? '' }}</span>
                  @endif
              </div>

              <p class="content-paragraph">{{ $product->small_desc }}
              </p>

              <hr>

              <div class="product-availability">
                  <span>Availabillity : </span>
                  <span class="inner-text">
                      @if ($product->has_variants)
                          {{ $quantity }} Products Available
                      @else
                          {{ $product->manage_stock ? $product->quantity . 'Products Available' : 'Available' }}
                      @endif
                  </span>
              </div>

              @if ($product->has_variants && !empty($variantAttributes))
                  <div class="product-variant-attributes" style="margin-top:0.8rem; display:flex; flex-wrap:wrap; gap:0.6rem;">
                      @foreach ($variantAttributes as $attr)
                          <span style="display:inline-flex; align-items:center; gap:0.4rem; background:#f5f5f5; border:1px solid #e0e0e0; border-radius:2rem; padding:0.4rem 1.2rem; font-size:1.3rem; color:#444;">
                              <strong style="color:#AE1C9A;">{{ $attr['name'] }}:</strong>
                              {{ $attr['value'] }}
                          </span>
                      @endforeach
                  </div>
              @endif

              @if ($product->has_variants && $product->Variants->isNotEmpty())
                  <div class="product-size">
                      <p class="size-title">Variants</p>

                      {{-- Custom Dropdown --}}
                      <div id="variant-dropdown" style="position:relative; user-select:none;">

                          {{-- Trigger Button --}}
                          <div id="variant-trigger"
                              style="
                                  display:flex; align-items:center; justify-content:space-between;
                                  width:100%; padding:1.1rem 1.6rem;
                                  border:2px solid #AE1C9A; border-radius:1.2rem;
                                  font-size:1.4rem; color:#232532; background:#fff;
                                  cursor:pointer; box-shadow:0 2px 8px rgba(174,28,154,0.10);
                                  transition: box-shadow 0.2s;
                              "
                              onclick="toggleVariantDropdown()"
                          >
                              <span id="variant-selected-label">
                                  @php $firstV = $variant->firstWhere('id', $variantId) ?? $variant->first(); @endphp
                                  @if($firstV)
                                      @foreach($firstV->VarientAttributes as $a)
                                          {{ $a->AttributeValue->attribute->name }}: {{ $a->AttributeValue->value }}@if(!$loop->last)  |  @endif
                                      @endforeach
                                  @endif
                              </span>
                              <svg id="variant-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" style="transition:transform 0.2s; flex-shrink:0; margin-left:0.8rem;">
                                  <path d="M6 9L12 15L18 9" stroke="#AE1C9A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                          </div>

                          {{-- Options List --}}
                          <div id="variant-options"
                              style="
                                  display:none; position:absolute; top:calc(100% + 6px); left:0; right:0;
                                  background:#fff; border:2px solid #AE1C9A; border-radius:1.2rem;
                                  box-shadow:0 8px 24px rgba(174,28,154,0.15);
                                  z-index:999; overflow:hidden;
                              "
                          >
                              @foreach ($variant as $v)
                                  @php
                                      $label = $v->VarientAttributes->map(fn($a) =>
                                          $a->AttributeValue->attribute->name.': '.$a->AttributeValue->value
                                      )->implode('  |  ');
                                  @endphp
                                  <div
                                      onclick="selectVariant({{ $v->id }}, '{{ addslashes($label) }}')"
                                      data-variant-id="{{ $v->id }}"
                                      style="
                                          padding:1rem 1.6rem; font-size:1.4rem; cursor:pointer;
                                          color:{{ $v->id == $variantId ? '#fff' : '#232532' }};
                                          background:{{ $v->id == $variantId ? '#AE1C9A' : '#fff' }};
                                          transition: background 0.15s, color 0.15s;
                                      "
                                      onmouseover="if(this.dataset.selected !== '1'){ this.style.background='rgba(174,28,154,0.10)'; this.style.color='#AE1C9A'; }"
                                      onmouseout="if(this.dataset.selected !== '1'){ this.style.background=''; this.style.color='#232532'; }"
                                      data-selected="{{ $v->id == $variantId ? '1' : '0' }}"
                                  >
                                      {{ $label }}
                                  </div>
                              @endforeach
                          </div>

                          {{-- Hidden input to sync with Livewire --}}
                          <input type="hidden" id="variant-hidden-input" value="{{ $variantId }}">
                      </div>

                      <style>
                          #variant-trigger:hover { box-shadow: 0 0 0 3px rgba(174,28,154,0.18); }
                      </style>

                      <script>
                          function toggleVariantDropdown() {
                              const opts = document.getElementById('variant-options');
                              const arrow = document.getElementById('variant-arrow');
                              const isOpen = opts.style.display === 'block';
                              opts.style.display = isOpen ? 'none' : 'block';
                              arrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
                          }

                          function selectVariant(id, label) {
                              // Update label
                              document.getElementById('variant-selected-label').textContent = label;

                              // Update selected styles on all options
                              document.querySelectorAll('#variant-options [data-variant-id]').forEach(el => {
                                  if (parseInt(el.dataset.variantId) === id) {
                                      el.style.background = '#AE1C9A';
                                      el.style.color = '#fff';
                                      el.dataset.selected = '1';
                                  } else {
                                      el.style.background = '';
                                      el.style.color = '#232532';
                                      el.dataset.selected = '0';
                                  }
                              });

                              // Close dropdown
                              document.getElementById('variant-options').style.display = 'none';
                              document.getElementById('variant-arrow').style.transform = 'rotate(0deg)';

                              // Dispatch to Livewire
                              @this.call('changeVariant', id);
                          }

                          // Close on outside click
                          document.addEventListener('click', function(e) {
                              const wrapper = document.getElementById('variant-dropdown');
                              if (wrapper && !wrapper.contains(e.target)) {
                                  document.getElementById('variant-options').style.display = 'none';
                                  document.getElementById('variant-arrow').style.transform = 'rotate(0deg)';
                              }
                          });
                      </script>
                  </div>
              @endif

              <div class="product-quantity">
                  <div class="quantity-wrapper">

                      @livewire('website.wishlist', ['product' => $product])
                      @livewire('website.cart.product-count')
                  </div>
                  @livewire('website.cart.product-cart', ['product' => $product, 'variantId' => $variantId], key('product-cart-'.$product->id))
              </div>
              <hr>

              <div class="product-details">
                  <p class="category">Category : <span class="inner-text">{{ $product->category->name }}</span></p>
                  <p class="sku">SKU : <span class="inner-text">{{ $product->sku }}</span></p>
              </div>
              <hr>
              <div class="product-report">
                  <a href="#" class="report" onclick="modalAction('.action')">
                      <span>
                          <svg width="15" height="16" viewBox="0 0 15 16" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M0 0C0.30478 0 0.585152 0 0.897442 0C0.908707 0.197137 0.919972 0.389267 0.932488 0.607056C1.30235 0.482516 1.64781 0.347336 2.00391 0.250332C3.83134 -0.247829 5.5555 0.0450599 7.19017 0.959399C7.97121 1.39686 8.7898 1.71165 9.68599 1.81178C10.9308 1.95072 12.0873 1.6716 13.1813 1.08832C13.4566 0.941876 13.7257 0.783541 14.0443 0.604553C14.0505 0.745991 14.0599 0.853634 14.0599 0.960651C14.0605 3.92396 14.058 6.88665 14.0662 9.84996C14.0668 10.079 13.9961 10.2042 13.7964 10.3143C11.4702 11.5973 9.14277 11.6123 6.82531 10.3106C4.99976 9.28546 3.14292 9.1484 1.22162 10.0164C0.990065 10.1209 0.908081 10.2524 0.909958 10.5096C0.921849 12.21 0.916217 13.911 0.916217 15.6114C0.916217 15.7353 0.916217 15.8586 0.916217 16C0.600172 16 0.312916 16 0 16C0 10.6779 0 5.35336 0 0Z"
                                  fill="#EB5757" />
                          </svg>
                      </span>
                      <span>Report This Item</span>
                  </a>

                  <div class="modal-wrapper action">
                      <div onclick="modalAction('.action')" class="anywhere-away"></div>

                      <div class="login-section account-section modal-main">
                          <div class="review-form">
                              <div class="review-content">
                                  <h5 class="comment-title">Report Products</h5>
                                  <div class="close-btn">
                                      <img src="assets/images/homepage-one/close-btn.png"
                                          onclick="modalAction('.action')" alt="close-btn">
                                  </div>
                              </div>
                              <div class="review-form-name address-form">
                                  <label for="reporttitle" class="form-label">Enter Report Ttile*</label>
                                  <input type="text" id="reporttitle" class="form-control"
                                      placeholder="Reports Headline here">
                              </div>
                              <div class="review-form-name address-form">
                                  <label for="reportnote" class="form-label">Enter Report Note*</label>
                                  <textarea name="ticketmassage" id="reportnote" cols="40" rows="3" class="form-control"
                                      placeholder="Type Here"></textarea>
                              </div>
                              <div class="login-btn text-center">
                                  <a href="#" onclick="modalAction('.action')" class="shop-btn">Submit
                                      Report</a>
                              </div>
                          </div>
                      </div>

                  </div>
              </div>
              @php
                  $shareUrl = urlencode(url()->current());
              @endphp
              <div class="product-share">
                  <p>Share This:</p>
                  <div class="social-icons">
                      <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank">
                          <span class="facebook">
                              <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path
                                      d="M3 16V9H0V6H3V4C3 1.3 4.7 0 7.1 0C8.3 0 9.2 0.1 9.5 0.1V2.9H7.8C6.5 2.9 6.2 3.5 6.2 4.4V6H10L9 9H6.3V16H3Z"
                                      fill="#3E75B2" />
                              </svg>
                          </span>
                      </a>
                      <a href="https://www.pinterest.com/pin/create/button/?url={{ $shareUrl }}&media={{ urlencode(asset($product->images->first()->file_name)) }}"
                          target="_blank">

                          <span class="pinterest">
                              <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path
                                      d="M8 0C3.6 0 0 3.6 0 8C0 11.4 2.1 14.3 5.1 15.4C5 14.8 5 13.8 5.1 13.1C5.2 12.5 6 9.1 6 9.1C6 9.1 5.8 8.7 5.8 8C5.8 6.9 6.5 6 7.3 6C8 6 8.3 6.5 8.3 7.1C8.3 7.8 7.9 8.8 7.6 9.8C7.4 10.6 8 11.2 8.8 11.2C10.2 11.2 11.3 9.7 11.3 7.5C11.3 5.6 9.9 4.2 8 4.2C5.7 4.2 4.4 5.9 4.4 7.7C4.4 8.4 4.7 9.1 5 9.5C5 9.7 5 9.8 5 9.9C4.9 10.2 4.8 10.7 4.8 10.8C4.8 10.9 4.7 11 4.5 10.9C3.5 10.4 2.9 9 2.9 7.8C2.9 5.3 4.7 3 8.2 3C11 3 13.1 5 13.1 7.6C13.1 10.4 11.4 12.6 8.9 12.6C8.1 12.6 7.3 12.2 7.1 11.7C7.1 11.7 6.7 13.2 6.6 13.6C6.4 14.3 5.9 15.2 5.6 15.7C6.4 15.9 7.2 16 8 16C12.4 16 16 12.4 16 8C16 3.6 12.4 0 8 0Z"
                                      fill="#E12828" />
                              </svg>
                          </span>
                      </a>
                      <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}" target="_blank">


                          <span class="twitter">
                              <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                  xmlns="http://www.w3.org/2000/svg">
                                  <path
                                      d="M17.0722 1.60052C16.432 1.88505 15.7562 2.06289 15.0448 2.16959C15.7562 1.74278 16.3253 1.06701 16.5742 0.248969C15.8985 0.640206 15.1515 0.924742 14.3335 1.10258C13.6933 0.426804 12.7686 0 11.7727 0C9.85206 0 8.28711 1.56495 8.28711 3.48557C8.28711 3.7701 8.32268 4.01907 8.39382 4.26804C5.51289 4.12577 2.9165 2.73866 1.17371 0.604639C0.889175 1.13814 0.71134 1.70722 0.71134 2.34742C0.71134 3.5567 1.31598 4.62371 2.27629 5.26392C1.70722 5.22835 1.17371 5.08608 0.675773 4.83711V4.87268C0.675773 6.5799 1.88505 8.00258 3.48557 8.32268C3.20103 8.39382 2.88093 8.42938 2.56082 8.42938C2.34742 8.42938 2.09845 8.39382 1.88505 8.35825C2.34742 9.74536 3.62784 10.7768 5.15722 10.7768C3.94794 11.7015 2.45412 12.2706 0.818041 12.2706C0.533505 12.2706 0.248969 12.2706 0 12.2351C1.56495 13.2309 3.37887 13.8 5.37062 13.8C11.8082 13.8 15.3294 8.46495 15.3294 3.84124C15.3294 3.69897 15.3294 3.52113 15.3294 3.37887C16.0052 2.9165 16.6098 2.31186 17.0722 1.60052Z"
                                      fill="#3FD1FF" />
                              </svg>
                          </span>
                      </a>
                  </div>
              </div>
          </div>
      </div>

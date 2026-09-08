@extends('layout.dashboard.app')

@section('title')
    Show Product
@endsection

@section('body')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Basic Forms</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('words.Home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.roles.index') }}">{{ __('words.Roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.roles.create') }}">
                                        {{ __('words.Create Roles') }}
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                @include('dashboard.includes.buttonheader')

            </div>
            <div class="card">
                <div class="card-content collapse show">

                    {{-- alerts --}}
                    @include('dashboard.includes.toster-error')
                    @include('dashboard.includes.toster-success')

                    <div class="card-body">

                        {{-- Product Info + Images --}}
                        <div class="row">

                            {{-- Product Information --}}
                            <div class="col-lg-6 col-md-7 mb-3">

                                <div class="product-info pr-lg-4">

                                    <h2 class="font-weight-bold mb-2">
                                        {{ $product->name }}
                                    </h2>

                                    <p class="text-muted mb-3">
                                        {{ $product->small_desc }}
                                    </p>

                                    <div class="mb-4">
                                        <p class="mb-2">
                                            {{ $product->desc }}
                                        </p>
                                    </div>

                                    {{-- Price --}}
                                    <div class="mb-4">

                                        @if ($product->has_variants)
                                            <span class="badge badge-warning px-3 py-2">
                                                Has Variants
                                            </span>
                                        @else
                                            <div class="d-flex align-items-center">

                                                <h2 class="text-primary mb-0 mr-2">
                                                    ${{ $product->price }}
                                                </h2>

                                                @if ($product->has_discount)
                                                    <span class="text-muted">
                                                        <del>
                                                            ${{ $product->price + $product->discount }}
                                                        </del>
                                                    </span>
                                                @endif

                                            </div>

                                            @if ($product->manage_stock)
                                                <div class="mt-2">
                                                    <span class="text-muted">
                                                        Quantity:
                                                    </span>

                                                    <strong>
                                                        {{ $product->quantity }}
                                                    </strong>
                                                </div>
                                            @endif
                                        @endif

                                    </div>

                                    <hr>

                                    {{-- Product Details --}}
                                    <div class="product-details mt-4">

                                        <div class="row">

                                            <div class="col-md-6 mb-3">
                                                <div class="detail-item">
                                                    <i class="fa fa-calendar-check text-success mr-2"></i>

                                                    <strong>Available For:</strong>

                                                    <span>
                                                        {{ $product->available_for ?: 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="detail-item">
                                                    <i class="fa fa-box text-primary mr-2"></i>

                                                    <strong>In Stock:</strong>

                                                    <span>
                                                        {{ $product->available_in_stock ? 'Yes' : 'No' }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="detail-item">
                                                    <i class="fa fa-barcode text-info mr-2"></i>

                                                    <strong>SKU:</strong>

                                                    <span>
                                                        {{ $product->sku }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="detail-item">
                                                    <i class="fa fa-eye text-info mr-2"></i>

                                                    <strong>Views:</strong>

                                                    <span>
                                                        {{ $product->views }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="detail-item">
                                                    <i class="fa fa-tag text-warning mr-2"></i>

                                                    <strong>Category:</strong>

                                                    <span>
                                                        {{ $product->category->name }}
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="detail-item">
                                                    <i class="fa fa-industry text-warning mr-2"></i>

                                                    <strong>Brand:</strong>

                                                    <span>
                                                        {{ $product->brand->name }}
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Product Images --}}
                            <div class="col-lg-6 col-md-5 mb-3">

                                <div class="product-images text-center">

                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

                                        <div class="carousel-inner rounded">

                                            @foreach ($product->images as $key => $image)
                                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                                                    <img class="d-block w-100 product-main-image"
                                                        src="{{ asset('uploads/products/' . $image->file_name) }}"
                                                        alt="{{ $product->name }}">

                                                </div>
                                            @endforeach

                                        </div>


                                        @if ($product->images->count() > 1)
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                                data-slide="prev">

                                                <span class="carousel-control-prev-icon"></span>

                                                <span class="sr-only">
                                                    Previous
                                                </span>

                                            </a>

                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                                data-slide="next">

                                                <span class="carousel-control-next-icon"></span>

                                                <span class="sr-only">
                                                    Next
                                                </span>

                                            </a>
                                        @endif

                                    </div>


                                    {{-- Fullscreen Button --}}
                                    <div class="mt-3">

                                        <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                            data-target="#fullscreenModal{{ $product->id }}">
                                            <i class="fa fa-expand mr-1"></i>
                                            View Fullscreen
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>




                        <div class="row mt-5">

                            <div class="col-12">

                                @if ($product->has_variants)
                                    <h4 class="mb-3">
                                        Product Variants
                                    </h4>

                                    <div class="table-responsive">

                                        <table class="table table-bordered table-striped w-100">

                                            <thead class="thead-light">

                                                <tr>
                                                    <th>#</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>Attributes</th>
                                                    <th>Actions</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                @foreach ($product->Variants as $variant)
                                                    <tr>

                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>

                                                        <td>
                                                            ${{ $variant->price }}
                                                        </td>

                                                        <td>
                                                            {{ $variant->stock }}
                                                        </td>

                                                        <td>

                                                            @foreach ($variant->VarientAttributes as $variantAttr)
                                                                <span class="badge badge-primary mr-1">
                                                                    {{ $variantAttr->AttributeValue->attribute->name }}:
                                                                    {{ $variantAttr->AttributeValue->value }}
                                                                </span>
                                                            @endforeach

                                                        </td>

                                                        <td>



                                                            <a href="#" class="btn btn-sm btn-danger delete_varient"
                                                                variant-id="{{ $variant->id }}">
                                                                <i class="fa fa-trash"></i>
                                                            </a>

                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>

                                        </table>

                                    </div>
                                @else
                                    <div class="text-muted">
                                        This Product has No Variants
                                    </div>
                                @endif

                            </div>

                        </div>

                    </div>


                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" id="fullscreenModal{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="fullscreenModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title" id="fullscreenModalLabel">
                        {{ $product->name }} Images
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div id="fullscreenCarousel" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">

                            @foreach ($product->images as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">

                                    <img class="d-block w-100" src="{{ asset('uploads/products/' . $image->file_name) }}"
                                        alt="First slide">


                                </div>
                            @endforeach

                        </div>
                        @if ($product->images->count() > 1)
                            {{-- Previous --}}
                            <a class="carousel-control-prev" href="#fullscreenCarousel" role="button"
                                data-slide="prev">

                                <span class="carousel-control-prev-icon" aria-hidden="true">
                                </span>

                                <span class="sr-only">
                                    Previous
                                </span>

                            </a>

                            {{-- Next --}}
                            <a class="carousel-control-next" href="#fullscreenCarousel" role="button"
                                data-slide="next">

                                <span class="carousel-control-next-icon" aria-hidden="true">
                                </span>

                                <span class="sr-only">
                                    Next
                                </span>

                            </a>
                        @endif
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

@push('css')
    <style>
        .product-info {
            padding: 10px 20px 10px 10px;
        }

        .product-info h2 {
            color: #2c3e50;
        }

        .product-details {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .detail-item {
            font-size: 14px;
            line-height: 1.8;
        }

        .detail-item i {
            width: 18px;
        }

        .detail-item strong {
            margin-right: 5px;
        }

        .product-images {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }

        .product-main-image {
            height: 420px;
            object-fit: contain;
            background: #fff;
            border-radius: 8px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 45px;
        }

        @media (max-width: 991px) {
            .product-info {
                padding-right: 10px;
            }

            .product-main-image {
                height: 350px;
            }
        }

        @media (max-width: 767px) {
            .product-images {
                margin-top: 20px;
            }

            .product-main-image {
                height: 300px;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        $(document).on('click', '.delete_varient', function(e) {
            e.preventDefault();
            let button = $(this);
            let variant_id = $(this).attr('variant-id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {

                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('dashboard.products.deleteVarient', ':id') }}".replace(':id',
                            variant_id),
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {

                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Product Deleted Successfully",
                                showConfirmButton: true,
                                timer: 1500
                            });
                            button.closest('tr').remove();

                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Cannot Delete",
                                text: xhr.responseJSON?.msg ?? "Something went wrong"
                            });

                        }

                    });


                }
            });
        });
    </script>
@endpush

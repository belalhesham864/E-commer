<div>

    <form class="form" wire:submit.prevent="firstStepSubmit">
        @csrf
        <div class="form-body ">
            <h4 class="form-section"><i class="fas fa-pen"></i> Create Product</h4>


<div class="steps-wrapper">

    <div class="step-item" wire:click="backStep(1)">

        <div class="step-circle {{ $currentStep == 1 ? 'active' : ($currentStep > 1 ? 'completed' : '') }}">

            @if ($currentStep > 1)
                <i class="la la-check"></i>
            @else
                1
            @endif

        </div>

        <span class="{{ $currentStep >= 1 ? 'active-text' : '' }}">
            Basic Information
        </span>

    </div>


    <div class="step-line {{ $currentStep > 1 ? 'completed-line' : '' }}"></div>

    <div class="step-item" wire:click="backStep(2)">

        <div class="step-circle {{ $currentStep == 2 ? 'active' : ($currentStep > 2 ? 'completed' : '') }}">

            @if ($currentStep > 2)
                <i class="la la-check"></i>
            @else
                2
            @endif

        </div>

        <span class="{{ $currentStep >= 2 ? 'active-text' : '' }}">
            Product Variants
        </span>

    </div>


    <div class="step-line {{ $currentStep > 2 ? 'completed-line' : '' }}"></div>


    <div class="step-item" wire:click="backStep(3)">

        <div class="step-circle {{ $currentStep == 3 ? 'active' : ($currentStep > 3 ? 'completed' : '') }}">

            @if ($currentStep > 3)
                <i class="la la-check"></i>
            @else
                3
            @endif

        </div>

        <span class="{{ $currentStep >= 3 ? 'active-text' : '' }}">
            Product Images
        </span>

    </div>


    <div class="step-line {{ $currentStep > 3 ? 'completed-line' : '' }}"></div>


    <div class="step-item" wire:click="backStep(4)">

        <div class="step-circle {{ $currentStep == 4 ? 'active' : '' }}">
            4
        </div>

        <span class="{{ $currentStep == 4 ? 'active-text' : '' }}">
            Confirmation
        </span>

    </div>

</div>
            <div class="{{ $currentStep != 1 ? 'displayNone' : '' }}">

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="productName">Product Name</label>

                            <input type="text" id="productName" wire:model.live="name"
                                class="form-control border-primary" placeholder="Enter Product Name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="smallDesc">Small Description</label>

                            <input type="text" id="smallDesc" wire:model.live="small_desc"
                                class="form-control border-primary" placeholder="Enter Small Description">

                            @error('small_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>

                            <textarea id="description" wire:model.live="desc" class="form-control border-primary" rows="4"
                                placeholder="Enter Product Description"></textarea>

                            @error('desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="category">Category</label>

                            <select id="category" wire:model.live="category_id" class="form-control border-primary">
                                <option value="">Select Category</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="brand">Brand</label>

                            <select id="brand" wire:model.live="brand_id" class="form-control border-primary">
                                <option value="">Select Brand</option>

                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">

                            <label for="sku">SKU</label>

                            <input type="text" id="sku" wire:model.live="sku"
                                class="form-control border-primary" placeholder="Enter SKU">
                            @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="availableFor">Available For</label>

                            <input type="date" id="availableFor" wire:model.live="available_for"
                                class="form-control border-primary">
                            @error('available_for')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="productTags">Product Tags</label>

                            <input type="text" id="productTags" wire:model.live="product_tags"
                                class="form-control border-primary" placeholder="Enter Product Tags">
                            @error('product_tags')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                    </div>

                </div>


                <div class="d-flex justify-content-end mt-2">

                    <button type="button" wire:click="firstStepSubmit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Next
                    </button>

                </div>

            </div>
          <div class="{{ $currentStep != 2 ? 'displayNone' : '' }}">

    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="has_variants">Has Variants</label>

                <select
wire:model.live="has_variants" id="has_variants" class="form-control border-primary">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>

                @error('has_variants')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if ($has_variants == 0)
            <div class="col-md-6">
                <div class="form-group">
                    <label for="price">Price</label>

                    <input type="number" wire:model.live="price" id="price" class="form-control border-primary" placeholder="Enter price"
                    >

                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif

    </div>


    @if ($has_variants == 0)

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="manage_stock">Manage Stock</label>

                    <select
 wire:model.live="manage_stock"  id="manage_stock"  class="form-control border-primary">
  <option value="0">No</option>
  <option value="1">Yes</option>
                    </select>

                    @error('manage_stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            @if ($manage_stock == 1)
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity">Quantity</label>

                        <input
                            type="number"
                            wire:model.live="quantity"
                            id="quantity"
                            class="form-control border-primary"
                            placeholder="Enter quantity"
                        >

                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @endif

        </div>

    @endif


    <div class="row">

        <div class="col-md-6">
            <div class="form-group">
                <label for="has_discount">Has Discount</label>

                <select
                    wire:model.live="has_discount"
                    id="has_discount"
                    class="form-control border-primary"
                >
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>

                @error('has_discount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>

        @if ($has_discount == 1)

            <div class="col-md-6">
                <div class="form-group">
                    <label for="discount">Discount</label>

                    <input
                        type="number"
                        wire:model.live="discount"
                        id="discount"
                        class="form-control border-primary"
                        placeholder="Enter discount"
                    >

                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        @endif

    </div>


    @if ($has_discount == 1)

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_discount">Start Discount</label>

                    <input
                        type="date"
                        wire:model.live="start_discount"
                        id="start_discount"
                        class="form-control border-primary"
                    >

                    @error('start_discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_discount">End Discount</label>

                    <input
                        type="date"
                        wire:model.live="end_discount"
                        id="end_discount"
                        class="form-control border-primary"
                    >

                    @error('end_discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

        </div>

    @endif

    @if($has_variants==1)
        <hr class="bg-black">
        @for($i=0;$i<$valuerowCount;$i++)
        <div class="row">
            <hr>
            <div class="col-3">
                <div class="form-group">
                    <label for="">price</label>
                    <input type="number"  wire:model="prices.{{ $i }}" class="form-control" placeholder="Enter Product Price">
                    @error('prices.' .$i)
                    <span class="text-danger">
                        {{ $message }}
                    </span>

                    @enderror
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="">quantity</label>
                    <input type="number"  wire:model="quantities.{{ $i }}" class="form-control" placeholder="Enter Product quantity">
                    @error('quantities.' .$i)
                    <span class="text-danger">
                        {{ $message }}
                    </span>

                    @enderror
                </div>
            </div>
            @foreach ($product_attributes as $attr )
            <div class="col-3">
                <div class="form-group">
                    <label for="">product {{ $attr->name }}</label>
                    <select wire:model="attributeValues.{{ $i }}.{{ $attr->id }}" class="form-control">
                        <option value="" selected> Select</option>
                        @foreach ($attr->attributeValues as $item )
                        <option value="{{ $item->id }}">{{ $item->value }}</option>

                        @endforeach
                    </select>
                </div>
            </div>
         <hr>
            @endforeach
     <hr class="bg-black">
        </div>
        @endfor
        <button type="button" wire:click="addNewVarient" class="btn btn-success">
            <i class="la la-plus"></i> Add New Variant
        </button>
       @if ($valuerowCount>1)
        <button type="button" wire:click="removeVarient" class="btn btn-danger">
            <i class="la la-trash"></i>
            Remove Varient
        </button>

       @endif
    @endif



    <div class="d-flex justify-content-between mt-2">

        <button
            type="button"
            wire:click="backStep(1)"
            class="btn btn-secondary"
        >
            <i class="ft-arrow-left"></i>
            Previous
        </button>

        <button
            type="button"
            wire:click="secondStepSubmit"
            class="btn btn-primary"
        >
            <i class="la la-check-square-o"></i>
            Next
        </button>

    </div>

</div>
            {{-- third Step --}}
           <div class="row {{ $currentStep != 3 ? 'displayNone' : '' }}">

    <div class="col-md-12">

        <div class="form-group">
            <label for="images">Product Images</label>

            <input
                type="file"
                wire:model.live="images"
                id="images"
                class="form-control border-primary"
                multiple
            >

            @error('images')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br>
         @if ($images)
    <div class="col-md-12">

        <div class="row">

            @foreach ($images as $key => $image)

                <div class="col-md-4 mb-3">

                    <div class="position-relative">

                        <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail rounded" style="width: 100%; height: 200px; object-fit: cover;"   >

                        <button  type="button"  wire:click="deleteImage({{ $key }})"  class="btn btn-danger btn-sm position-absolute"  style="top: 5px; right: 5px;"
                        > <i class="fa fa-trash"></i>
                        </button>

                    </div>

                </div>

            @endforeach

        </div>

    </div>
@endif
        </div>

    </div>


    <div class="col-md-12">
        <div class="d-flex justify-content-between mt-2">

            <button
                type="button"
                wire:click="backStep(2)"
                class="btn btn-secondary"
            >
                <i class="ft-arrow-left"></i>
                Previous
            </button>

            <button
                type="button"
                wire:click="thirdStepSubmit"
                class="btn btn-primary"
            >
                <i class="la la-check-square-o"></i>
                Submit
            </button>

        </div>
    </div>

</div>
            {{-- four Step --}}
            <div class="row {{ $currentStep != 4 ? 'displayNone' : '' }}">



                <div class="d-flex justify-content-between">
                    <button type="button" wire:click="backStep(3)" class="btn btn-secondary mr-1">
                        <i class="ft-x"></i> pervioes
                    </button>
                    <button type="button" wire:click="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Submit
                    </button>
                </div>
            </div>

        </div>

    </form>
</div>

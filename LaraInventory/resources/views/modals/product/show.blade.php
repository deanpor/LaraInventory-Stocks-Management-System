<x-panel>

    <!-- Image -->
    <div class="text-center" style="background-color: #ffffff;">>
        <div class="text-muted">UPC Code:</div>
        <img src="{{ asset('storage/barcode/products/barcode_'.$product->id.'.png') }}" alt="UPC barcode" />
    </div>
    <br>
    <br>

    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Product ID:</div>
        <input name="id" type="text"  value="{{$product->id}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Product Name:</div>
        <input name="name" type="text"  value="{{$product->name}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->

    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Product SKU:</div>
        <input name="sku" type="text"  value="{{$product->sku}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->

    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Product Description:</div>
        <input name="description" type="text"  value="{{$product->description}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Status:</div>
        <input name="status" type="text"  value="{{$product->status}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Created At:</div>
        <input name="created_at" type="text"  value="{{$product->created_at}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Created By:</div>
        <input name="created_by" type="text"  value="{{$product->creator->name}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Last Updated At:</div>
        <input name="updated_at" type="text"  value="{{$product->updated_at}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Last Updated By:</div>
        <input name="updated_by" type="text"  value="{{$product->UpdatedBy->name}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
</x-panel>

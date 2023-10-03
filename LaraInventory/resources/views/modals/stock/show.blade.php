<x-panel>

    <div class="d-flex flex-column flex-root">
        <!--begin::Create Product -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Show Stock</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">LaraInventory System</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Stock ID:</div>
                                <input name="id" type="text" value="{{$stock->id}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Stock Of Product:</div>
                                <input name="name" type="text" value="{{$stock->ProductOf->name}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Cost Price:</div>
                                <input name="cost_price" type="text" value="{{$stock->cost_price}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Sell Price:</div>
                                <input name="sell_price" type="text" value="{{$stock->sell_price}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Status:</div>
                                <input name="status" type="text" value="{{$stock->status}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Created At:</div>
                                <input name="created_at" type="text" value="{{$stock->created_at}}"
                                       autocomplete="off" class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Created By:</div>
                                <input name="created_by" type="text" value="{{$stock->Creator->name}}"
                                       autocomplete="off" class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Last Updated At:</div>
                                <input name="updated_at" type="text" value="{{$stock->updated_at}}"
                                       autocomplete="off" class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Last Updated By:</div>
                                <input name="updated_by" type="text" value="{{$stock->LastUpdatedBy->name}}"
                                       autocomplete="off" class="form-control bg-transparent" readonly/>
                            </div>

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

            </div>
            <!--end::Body-->

        </div>
        <!--end::Create Product-->
    </div>

</x-panel>


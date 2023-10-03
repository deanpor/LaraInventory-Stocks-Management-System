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
                        <!--begin::Form-->
                        <form id="delete_stock" class="mt-10">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Delete Stock</h1>
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
                                <input name="cost_price" type="text" value="{{number_format($stock->cost_price,2)}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Sell Price:</div>
                                <input name="sell_price" type="text" value="{{number_format($stock->sell_price, 2)}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Points:</div>
                                <input name="points" type="text" value="{{$stock->points}}" autocomplete="off"
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
                                <input name="created_by" type="text" value="{{$stock->creator->name}}"
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
                                <input name="updated_by" type="text" value="{{$stock->lastUpdatedBy->name}}"
                                       autocomplete="off" class="form-control bg-transparent" readonly/>
                            </div>

                            <!--begin::Input group=-->
                            <div>
                                <x-form.button>Delete Stock</x-form.button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

            </div>
            <!--end::Body-->

        </div>
        <!--end::Create Product-->
    </div>

    <script>
        var formId = '#delete_stock';

        $(formId).submit(function (event) {
            event.preventDefault();
            var thisForm = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to delete this stock?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var formInputs = thisForm.find("input, textarea, button, select");
                    var formData = thisForm.serialize();
                    formInputs.prop("disabled", true);
                    ToastrProcessing();

                    $.ajax({
                        url: "{{ route('stock.delete', $stock->id) }}",
                        method: "POST",
                        dataType: "json",
                        data: formData,
                        success: function (response) {
                            if (response['status'] == 1) {
                                ToastrSuccess('', response['message']);
                                thisForm.trigger("reset");
                                setTimeout(function () {
                                    window.location.href = "{{ route('stock.search') }}";
                                }, 500);
                            } else {
                                ToastrDangerJSONHandler('', response['message']);
                            }
                        },
                        error: function (response) {
                            console.log(response['status']);
                            console.log(response['message']);
                            if (response.status == 0)
                                ToastrDanger('Server Connection Error', 'Error ' + response.status + ': No Internet Connection Or Server Is Down');
                            else
                                ToastrDanger('', 'Error ' + response.status + ': ' + response.statusText);
                        }
                    })
                        .always(function (response) {
                            formInputs.prop("disabled", false);
                        });
                }
            });
        });
    </script>

</x-panel>


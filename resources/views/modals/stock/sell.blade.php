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

                        <form id="sell_stock" class="mt-10">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Sell Stock</h1>
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
                                <input name="sell_price" type="text" value="{{number_format($stock->sell_price,2)}}" autocomplete="off"
                                       class="form-control bg-transparent" readonly/>
                            </div>

                            <div>
                                <x-form.field>
                                    <x-form.label name="customer"/>

                                    <select class="form-control bg-transparent border border-gray-200 p-2 w-full rounded" name="customer_id" id="customer_id">

                                        @foreach ($customers as $customer)
                                            <option class="form-select" value="{{$customer->id}}">{{ucwords($customer -> name)}}</option>
                                        @endforeach

                                    </select>
                                    <x-form.error name="customer"/>
                                </x-form.field>

                            </div>

                            <input name="status" type="hidden" value="Deleted"/>
                            <!--begin::Input group=-->
                            <div>
                                <x-form.button>Sell Stock</x-form.button>
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
        var formId = '#sell_stock';  // Setup form id variable with # here

        $(formId).submit(function (event) {
            // Prevent form submission normally
            event.preventDefault();
            var thisForm = $(this);

            Swal.fire({
                title:'Are you sure?',
                text:'You want to sell this stock: #{{$stock->id}}?',
                icon:'warning',
                showCancelButton:true,
                confirmButtonText: 'Yes, sell it!',
                cancelButtonText: 'Cancel'

            }).then((result)=>{
                if(result.isConfirmed){
                    var formInputs = thisForm.find("input, textarea, button, select");  // Select all the inputs in the form

                    // Serialize the data in the form for Ajax submit
                    var formData = thisForm.serialize();  // Use this line if form is text only without file upload
                    // var formData = new FormData(this);  // Use this line if form is multipart / involve file upload

                    // Disable inputs during Ajax submission & show processing message
                    formInputs.prop("disabled", true);
                    ToastrProcessing();

                    $.ajax({
                        url: "{{route('stock.sell_stock', $stock->id)}}",
                        method: "POST",
                        dataType: "json",
                        // contentType: false,       // Uncomment these 3 lines if the form is multipart / involve file upload - The content type used when sending data to the server.
                        // cache: false,             // To enable request pages to be cached
                        // processData: false,       // To send DOMDocument or non processed data file it is set to false
                        data: formData,
                        success: function (response) {
                            if (response['status'] == 1) {
                                ToastrSuccess('', response['message']);
                                thisForm.trigger("reset"); // Reset the form fields
                                setTimeout(function () {
                                    window.location.href = "{{route('stock.in_stock')}}";
                                    //  window.reload(); // reload to same page
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


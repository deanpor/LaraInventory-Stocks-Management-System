<x-panel>
    <!--begin::Main-->
    <!--begin::Root-->
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
                        <form id="update_user">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Update Personal Info</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">LaraInventory System</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">User ID:</div>
                                <input name="id" type="text"  value="{{$user->id}}" autocomplete="off" class="form-control bg-transparent" readonly/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Name:</div>
                                <input name="name" type="text"  value="{{$user->name}}" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Email:</div>
                                <input name="email" type="text"  value="{{$user->email}}" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            <!--begin::Input group=-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <div class="text-muted">Contact Number:</div>
                                <input name="contact_number" type="text"  value="{{$user->contact_number}}" autocomplete="off" class="form-control bg-transparent"/>
                            </div>
                            <!--begin::Input group=-->

                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <x-form.input name="password" type="password" autocomplete="new-password"/>
                                <!--end::Password-->
                            </div>

                            <input name="old_email" type="hidden" value="{{$user->email}}"/>

                            <!--end::Input group=-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <x-form.button>Update Personal Information</x-form.button>
                            </div>
                            <!--end::Submit button-->

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
        var formId = '#update_user';  // Setup form id variable with # here

        $(formId).submit(function(event){
            // Prevent form submission normally
            event.preventDefault();
            var thisForm = $(this);
            var formInputs = thisForm.find("input, textarea, button, select, password");  // Select all the inputs in the form

            // Serialize the data in the form for Ajax submit
            var formData = thisForm.serialize();  // Use this line if form is text only without file upload
            // var formData = new FormData(this);  // Use this line if form is multipart / involve file upload

            // Disable inputs during Ajax submission & show processing message
            formInputs.prop("disabled", true);
            ToastrProcessing();

            $.ajax({
                url: "{{route('user.update', auth()->user()->id)}}",
                method: "POST",
                dataType: "json",
                // contentType: false,       // Uncomment these 3 lines if the form is multipart / involve file upload - The content type used when sending data to the server.
                // cache: false,             // To enable request pages to be cached
                // processData: false,       // To send DOMDocument or non processed data file it is set to false
                data: formData,
                success: function(response) {
                    if(response['status'] == 1) {
                        ToastrSuccess('', response['message']);
                        thisForm.trigger("reset"); // Reset the form fields
                        setTimeout(function () {
                            window.location.href ="{{route('product.search')}}";
                            //  window.reload(); // reload to same page
                        }, 500);
                    }
                    else{
                        ToastrDangerJSONHandler('',response['message']);
                    }
                },
                warning: function(response) {
                    if(response['status'] == 2) {
                        ToastrSuccess('', response['message']);
                        thisForm.trigger("reset"); // Reset the form fields
                        setTimeout(function () {
                            window.location.href ="{{route('product.search')}}";
                            //  window.reload(); // reload to same page
                        }, 500);
                    }
                    else{
                        ToastrDangerJSONHandler('',response['message']);
                    }
                },
                error : function(response){
                    console.log(response['status']);
                    console.log(response['message']);
                    if (response.status == 0)
                        ToastrDanger('Server Connection Error', 'Error '+response.status+': No Internet Connection Or Server Is Down');
                    else
                        ToastrDanger('', 'Error '+response.status+': '+response.statusText);
                }
            })
                .always( function(response){
                    formInputs.prop("disabled", false);

                });
        });
    </script>
</x-panel>

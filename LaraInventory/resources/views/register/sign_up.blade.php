<x-panel>
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form id="sign_up" method="POST" action="/register" class="mt-10">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">LaraInventory System</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Name-->
                                <x-form.input name="name" type="name"/>
                                <!--end::Name-->
                            </div>
                            <!--end::Input wrapper-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <x-form.input name="email" type="email" autocomplete="username"/>
                                <!--end::Email-->
                            </div>
                            <!--end::Input wrapper-->

                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                       for="contact_number">
                                    Contact Number
                                </label>

                                <input class="form-control bg-transparent border border-gray-200 p-2 w-full rounded"
                                       type="text"
                                       name="contact_number"
                                       id="contact_number"
                                       value="{{old('contact_number')}}">

                                @error('contact_number')
                                <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>
                            <!--end::Input wrapper-->


                            <!--begin::Input group-->
                            <div class="fv-row mb-8">
                                    <!--begin::Input wrapper-->
                                    <x-form.input id="password" name="password" type="password"/>
                            </div>
                                <!--end::Wrapper-->


                            <!--end::Input group=-->

                            <!--end::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::checkpass-->
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                       for="repeat_password">
                                    Repeat Password
                                </label>
                                <input type="password" name="repeat_password" autocomplete="off"
                                       class="form-control bg-transparent" id="repeat_password" onkeyup="passCheck()" required>
                                <p id="repeat_passErr" class="error" style="color: red"></p>
                                @error('repeat_password')
                                <p class="text-danger">{{$message}}</p>
                                @enderror

                            </div>

                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <x-form.button id="sign_up">Sign Up</x-form.button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                                <a href="/" class="link-primary fw-semibold">Sign in</a></div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->

            </div>
            <!--end::Body-->

        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--begin::Javascript-->
    <x-javascript.global_and_vendor_javascript/>
    <script>

        var rPassError= false;


        function passCheck() {

            if (document.getElementById("password").value != document.getElementById("repeat_password").value) {
                document.getElementById("repeat_passErr").innerHTML = "*Retype password is not same as password.";
                rPassError = true;
            }
            else {
                document.getElementById("repeat_passErr").innerHTML = null;
                rPassError = false;
            }
        }




    </script>
    <!--end::Global Javascript Bundle-->



    <!--end::Javascript-->
</x-panel>

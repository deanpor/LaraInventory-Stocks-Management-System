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
                        <form id="sign_up_form" method="POST" class="mt-10">
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

                            {{--                            <div class="row mb-8">--}}
                            {{--                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"--}}
                            {{--                                       for="user_role">--}}
                            {{--                                    Sign Up As:--}}
                            {{--                                </label>--}}

                            {{--                                <div class="col-md-6">--}}
                            {{--                                    <label class="radio-inline">--}}
                            {{--                                        <input type="radio" name="user_role" value="customer"> Customer--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                                <div class="col-md-6">--}}
                            {{--                                    <label class="radio-inline">--}}
                            {{--                                        <input type="radio" name="user_role" value="user" checked> Seller--}}
                            {{--                                    </label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

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

                            <!--begin::Accept-->
                            <div class="fv-row mb-8">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="toc" value="1" id="toc"
                                           onClick="Trychecked()"/>
                                    <span class="form-check-label fw-semibold text-gray-700 fs-base ms-1">Accept the<a title='Terms and conditions'
                                                                                                                       data-bs-toggle='modal'
                                                                                                                       data-bs-target='#modal-lg-1'
                                                                                                                       href="{{route('user.terms')}}" class="ms-1 link-primary">Terms</a>
                                    </span> and Condition.
                                </label>
                            </div>
                            <!--end::Accept-->

                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button class="btn btn-primary" id="sign_up" disabled>Sign Up</button>
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

        var toc =document.getElementById("toc");
        var submit_button = document.getElementById("sign_up");

        toc.addEventListener('change', function(){ //When the checkbox's status changes, the event listener function is called.
            submit_button.disabled =! this.checked; // the disabled attribute of the submit button is updated based on the checked property of the checkbox. If the checkbox is checked, the submit button will be enabled; otherwise, it will be disabled.
        });


    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const signupButton = document.getElementById('sign_up');

            signupButton.addEventListener('click', function() {

                const form = document.getElementById('sign_up_form');

                form.action = 'register';
                form.submit();
            });
        });

    </script>
    {{--    <script>--}}
    {{--        document.addEventListener('DOMContentLoaded', function() {--}}
    {{--            const signupButton = document.getElementById('sign_up');--}}

    {{--            signupButton.addEventListener('click', function() {--}}
    {{--                const role = document.querySelector('input[name="user_role"]:checked').value;--}}
    {{--                const form = document.getElementById('sign_up_form');--}}

    {{--                let url;--}}
    {{--                if (role === 'user') {--}}
    {{--                    url = 'user/create'; // Replace with your actual seller signup route--}}
    {{--                } else if (role === 'customer') {--}}
    {{--                    url = 'customer/create'; // Replace with your actual customer signup route--}}
    {{--                }--}}

    {{--                form.action = url;--}}
    {{--                form.submit();--}}
    {{--            });--}}
    {{--        });--}}

    {{--    </script>--}}
    {{--    <script>--}}
    {{--        document.addEventListener('DOMContentLoaded', function () {--}}
    {{--            var sign_up_form = document.getElementById('sign_up');--}}
    {{--            var radioButtons = sign_up_form.querySelectorAll('input[type="radio"]');--}}


    {{--            radioButtons.forEach(function (radio) {--}}
    {{--                radio.addEventListener('change', function () {--}}
    {{--                    sign_up_form.action = this.value + '/create';--}}
    {{--                });--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}

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
    <x-modals/>



    <!--end::Javascript-->
</x-panel>

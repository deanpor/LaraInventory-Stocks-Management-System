<x-panel>
    <!--begin::Main-->
    <!--begin::Root-->

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <x-layout>
                    <!--end::Header-->
                    <!--begin::Toolbar-->
                    <div class="toolbar mb-n1 pt-3 mb-lg-n3 pt-lg-6" id="kt_toolbar">
                        <!--begin::Container-->
                        <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap gap-2">

                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Toolbar-->
                    <!--begin::Container-->
                    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
                        <!--begin::Card-->
                        <div class="content flex-row-fluid" id="kt_content">
                            <div class="card shadow-sm">
                                <div class="card shadow-sm">
                                    <div class="card-header pt-8 px-10">
                                        <h3>Stock Search</h3>
                                    </div>
                                    <form>
                                        <div class="card-body row">
                                            <h3 class="card-title">Stocks</h3><br>
                                            <select class="form-select form-select-solid" name="product">
                                                @if($product_chose != null)
                                                    <option value="{{$product_chose->id}}" hidden>{{$product_chose->name}}</option>
                                                @endif
                                                <option value="">All Stocks</option>
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>


                                        </div>

                                        <div class="card-body flex">
                                            <h3 class="card-title">Status</h3><br>
                                            <select class="form-select form-select-solid" name="status">
                                                @if($status!=null)
                                                    <option value=""hidden>{{$status}}</option>
                                                @endif
                                                <option value="">All Status</option>
                                                <option value="In Stock">In Stock</option>
                                                <option value="Sold">Sold</option>

                                            </select>
                                        </div>

                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-success me-5">Search</button>
                                            <a type="button" class="btn btn-secondary" href="{{route('stock.search')}}">Cancel</a>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="card-toolbar text-end my-5">
                                        <button type="button" class="mx-2 btn btn-sm btn-light-success" title='Create Stock' data-bs-toggle='modal' data-bs-target='#modal-lg-1' class="menu-link px-5" href="{{route('stock.create')}}">
                                            Create Stock
                                        </button>

                                        <a href='{{route('stock.deleted')}}'> <span class="mx-5">Show Deleted Stocks</span></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--begin::Table-->
                                    <form id="deleteForm" action="{{ route('stock.multi.delete') }}" method="POST">
                                        @csrf
                                        <table id="kt_datatable_dom_positioning"
                                               class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                            <thead>
                                            <tr class="fw-bold fs-6 text-gray-800 px-7">

                                                <th>Stock ID</th>
                                                <th><input type="checkbox" name="checkall" onclick="checkAll();">Check All</th>
                                                <th>Product Name</th>
                                                <th>Cost Price</th>
                                                <th>Sell Price</th>
                                                <th>Stock Points</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($stocks as $stock)
                                                <tr>

                                                    <td>{{$stock->id}}</td>
                                                    <td><input type="checkbox" name="checkBox" class="checkbox" value="{{ $stock->id }}" onclick="checkOne();"></td>
                                                    <td>{{$stock->ProductOf->name}}</td>
                                                    <td>{{number_format($stock->cost_price,2)}}</td>
                                                    <td>{{number_format($stock->sell_price, 2)}}</td>
                                                    <td>{{$stock->points}}</td>
                                                    <td style="color: {{ $stock->status==='In Stock' ? 'white' : 'red' }}">{{$stock->status}}</td>
                                                    <td>
                                                        <a title='Stock Details Of {{$stock->ProductOf->name}}'
                                                           data-bs-toggle='modal'
                                                           data-bs-target='#modal-lg-1'
                                                           href='/stock/{{$stock->id}}'
                                                           type="button" class="btn btn-secondary">
                                                            <span class="bi-search"></span>
                                                        </a>

                                                        <a title='Edit Details Of {{$stock->ProductOf->name}}'
                                                           data-bs-toggle='modal'
                                                           data-bs-target='#modal-lg-1'
                                                           href='{{route('stock.update',$stock->id)}}'
                                                           type="button" class="btn btn-primary">
                                                            <span class="bi-pencil"></span>
                                                        </a>

                                                        <a title='Delete Product: {{$stock->ProductOf->name}}'
                                                           data-bs-toggle='modal'
                                                           data-bs-target='#modal-lg-1'
                                                           href='{{route('stock.delete',$stock->id)}}'
                                                           type="button" class="btn btn-danger">
                                                            <span class="bi-trash"></span>
                                                        </a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <!--end::Table-->
                                        <div class="card-footer text-center">
                                            <button type="submit" class="btn btn-danger me-5">Delete Selected</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--end::Cards-->
                    </div>
                    <!--end::Container-->
                    <!--begin::Footer-->
                </x-layout>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                          fill="currentColor"/>
					<path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="currentColor"/>
				</svg>
			</span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->
    <!--begin::Javascript-->
    <script>

        var checkBoxes = document.getElementsByName('checkBox');
        // The [0] notation is used to access the first element in the NodeList returned by the document.getElementsByName('checkall') function.
        // This is based on the assumption that there is only one element with the name 'checkall'.
        var checkall = document.getElementsByName('checkall')[0];
        var deleteForm = document.getElementById('deleteForm');

        function checkAll() {
            if (checkall.checked == true) {
                for (i = 0; i < checkBoxes.length; i++)
                    checkBoxes[i].checked = true;

            }
            else {
                for (i = 0; i < checkBoxes.length; i++)
                    checkBoxes[i].checked = false;
            }
        }
        function checkOne() {
            var selectedStocks = [];
            for (var i = 0; i < checkBoxes.length; i++) {
                if (checkBoxes[i].checked) {
                    selectedStocks.push(checkBoxes[i].value);
                }
            }
            // Update the hidden input field with selected stock IDs
            selectedStocksInput.value = selectedStocks.join(',');
        }


        // Delete form submission
        deleteForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            var selectedStocks = [];
            for (var i = 0; i < checkBoxes.length; i++) {
                if (checkBoxes[i].checked) {
                    selectedStocks.push(checkBoxes[i].value);
                }
            }

            if (selectedStocks.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select at least one stock to delete.'
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You are about to delete the selected stocks.',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create an input element to hold the selected stocks
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'selectedStocks'; // Make sure this matches the field name in your form
                        input.value = selectedStocks.join(',');
                        deleteForm.appendChild(input);

                        // Submit the form
                        deleteForm.submit();
                    }
                });
            }
        });
        // deleteForm.addEventListener('submit', function (event) {
        //     var selectedStocks = [];
        //     for (var i = 0; i < checkBoxes.length; i++) {
        //         if (checkBoxes[i].checked) {
        //             selectedStocks.push(checkBoxes[i].value);
        //         }
        //     }
        //
        //     if (selectedStocks.length === 0) {
        //         event.preventDefault();
        //         alert('Please select at least one stock to delete.');
        //     } else {
        //         var confirmDelete = confirm('Are you sure you want to delete the selected stocks?');
        //         if (!confirmDelete) {
        //             event.preventDefault();
        //         } else {
        //             var input = document.createElement('input');
        //             input.type = 'hidden';
        //             input.name = 'selectedStocks';
        //             input.value = selectedStocks.join(',');
        //             deleteForm.appendChild(input);
        //         }
        //     }
        // });

        // deleteForm.addEventListener('submit', function (event) {
        //
        //     var selectedStocks = [];
        //     for (var i = 0; i < checkBoxes.length; i++) {
        //         if (checkBoxes[i].checked) {
        //             selectedStocks.push(checkBoxes[i].value);
        //         }
        //     }
        //
        //     if (selectedStocks.length === 0) {
        //         event.preventDefault();
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Oops...',
        //             text: 'Please select at least one stock to delete.'
        //         });
        //     } else {
        //         Swal.fire({
        //             icon: 'warning',
        //             title: 'Are you sure?',
        //             text: 'You are about to delete the selected stocks.',
        //             showCancelButton: true,
        //             confirmButtonText: 'Yes, delete!',
        //             cancelButtonText: 'Cancel'
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 event.preventDefault();
        //                 var input = document.createElement('input');
        //                 input.type = 'hidden';
        //                 input.name = 'selectedStocks';
        //                 input.value = selectedStocks.join(',');
        //                 deleteForm.appendChild(input);
        //             } else {
        //                 event.preventDefault();
        //             }
        //         });
        //     }
        // });
        //



        // function checkOne() {
        //     var checkBox = document.getElementsByName('checkBox');
        //     for (i = 0; i < checkBox.length; i++) {
        //         if (checkBox[i].checked == false)
        //             checkall.checked = false;
        //     }
        // }

    </script>
    <x-javascript.global_and_vendor_javascript/>
    <x-javascript.table_custom_javascript/>
    <!--end::Javascript-->
    <x-modals/>
</x-panel>

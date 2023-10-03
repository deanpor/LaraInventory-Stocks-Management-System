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
                                <div class="card-header">
                                    <h3 class="card-title">Customers</h3>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-light-success" title='Create Customer' data-bs-toggle='modal' data-bs-target='#modal-lg-1' class="menu-link px-5" href="{{route('customer.create')}}">
                                            Create Customer
                                        </button>
                                        <a href='{{route('customer.deleted')}}'> <span class="mx-5">Show Deleted Customers</span></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--begin::Table-->
                                    <table id="kt_datatable_dom_positioning"
                                           class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                        <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 px-7">
                                            <th>Customer Id</th>
                                            <th>Name</th>
                                            <th>Contact Number</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td>{{$customer->id}}</td>
                                                <td>{{$customer->name}}</td>
                                                <td>{{$customer->contact_number}}</td>
                                                <td>{{$customer->status}}</td>
                                                <td>
                                                    <a title='Customer Details Of {{$customer->name}}'
                                                       data-bs-toggle='modal'
                                                       data-bs-target='#modal-lg-1'
                                                       href='{{route('customer.show', $customer->id)}}}'
                                                       type="button" class="btn btn-secondary">
                                                        <span class="bi-search"></span>
                                                    </a>

                                                    <a title='Edit Details Of {{$customer->name}}'
                                                       data-bs-toggle='modal'
                                                       data-bs-target='#modal-lg-1'
                                                       href='{{route('customer.update',$customer->id)}}'
                                                       type="button" class="btn btn-primary">
                                                        <span class="bi-pencil"></span>
                                                    </a>

                                                    <a title='Delete Product: {{$customer->name}}'
                                                       data-bs-toggle='modal'
                                                       data-bs-target='#modal-lg-1'
                                                       href='{{route('customer.delete',$customer->id)}}'
                                                       type="button" class="btn btn-danger">
                                                        <span class="bi-trash"></span>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
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
    <x-javascript.global_and_vendor_javascript/>
    <x-javascript.table_custom_javascript/>
    <!--end::Javascript-->
    <x-modals/>
</x-panel>

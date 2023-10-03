<x-panel>
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Customer ID:</div>
        <input name="id" type="text"  value="{{$customer->id}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Customer Name:</div>
        <input name="name" type="text"  value="{{$customer->name}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Email:</div>
        <input name="email" type="text"  value="{{$customer->email}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Contact Number:</div>
        <input name="contact_number" type="text"  value="{{$customer->contact_number}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->

    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Status:</div>
        <input name="status" type="text"  value="{{$customer->status}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->

    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Points Carried:</div>
        <input name="status" type="text"  value="{{$customer->points_rewards}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Created At:</div>
        <input name="created_at" type="text"  value="{{$customer->created_at}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Created By:</div>
        <input name="created_by" type="text"  value="{{$customer->Creator->name}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Last Updated At:</div>
        <input name="updated_at" type="text"  value="{{$customer->updated_at}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <div class="text-muted">Last Updated By:</div>
        <input name="updated_by" type="text"  value="{{$customer->LastUpdatedBy->name}}" autocomplete="off" class="form-control bg-transparent" readonly/>
    </div>
    <!--begin::Input group=-->
</x-panel>

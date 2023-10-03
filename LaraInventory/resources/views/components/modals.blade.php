<!--begin::Modal-->
<div class="modal fade" id="modal-lg-1" tabindex="-1" role="dialog"
     aria-labelledby="modal-lg-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
                <h3> Loading... Please Wait...</h3>
                <p>If this takes more than 5 seconds, please check your internet connection or close and reopen this modal.</p>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="modal-xl-1" tabindex="-1" role="dialog"
     aria-labelledby="modal-xl-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <h3>Loading... Please Wait...</h3>
                <p>If this takes more than 5 seconds, please check your internet connection or close and reopen this modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->


<!-- Load URL Into Modal jQuery -->
<script>
    var defaultModalHTMLContent = "<h3>Loading... Please Wait...</h3><p>If this takes more than 5 seconds, please check your internet connection or close and reopen this modal.</p>";

    $("#modal-lg-1").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-title").text(link.attr('title'));
        $(this).find(".modal-body").load(link.attr("href"));
    });
    $("#modal-lg-1").on('hidden.bs.modal', function(e)
    {
        $(this).find(".modal-title").text("");
        $(this).find(".modal-body").html(defaultModalHTMLContent);
    });

    $("#modal-xl-1").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget);
        $(this).find(".modal-title").text(link.attr('title'));
        $(this).find(".modal-body").load(link.attr("href"));
    });
    $("#modal-xl-1").on('hidden.bs.modal', function(e)
    {
        $(this).find(".modal-title").text("");
        $(this).find(".modal-body").html(defaultModalHTMLContent);
    });
</script>
<!-- End : Load URL Into Modal jQuery -->

"use strict";

// Class definition

function ToastrSuccess(title, message) {
    // Remove all Toaster Notifications Before Showing The New One
    toastr.remove();

    title = title || "Success!"  // Notification Title Replace With Success if no title being passed

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "escapeHtml": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    toastr.success(message, title);
};

function ToastrDanger(title, message) {
    // Remove all Toaster Notifications Before Showing The New One
    toastr.remove();

    title = title || "Opps! Something Went Wrong."  // Notification Title Replace With Success if no title being passed

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "escapeHtml": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    toastr.error(message, title);
};

function ToastrWarning(title, message) {
    // Remove all Toaster Notifications Before Showing The New One
    toastr.remove();

    title = title || "Heads Up!"  // Notification Title Replace With Success if no title being passed

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "escapeHtml": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    toastr.warning(message, title);
};

function ToastrInfo(title, message) {
    // Remove all Toaster Notifications Before Showing The New One
    toastr.remove();

    title = title || "Take Note!"  // Notification Title Replace With Success if no title being passed

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "escapeHtml": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    toastr.info(message, title);
};

function ToastrProcessing() {
    // Remove all Toaster Notifications Before Showing The New One
    toastr.remove();

    var title = "Processing Your Request"  // Notification Title Replace With Success if no title being passed
    var message = "Please Wait..."

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "escapeHtml": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    toastr.warning(message, title);
};

function ToastrDangerJSONHandler(title, message) {
    // Remove all Toaster Notifications Before Showing The New One
    toastr.remove();

    title = title || "Opss, Something Not Right."  // Notification Title Replace With Success if no title being passed

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toastr-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "escapeHtml": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "swing",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
    };

    // Remove JSON formatting and replace with &bull; point form
    if (/^[\],:{}\s]*$/.test(message.replace(/\\["\\\/bfnrtu]/g, '@').
    replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').
    replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
        // response is json
        var messageObject = JSON.parse(message);
        var messageString = "";
        for (const [key, value] of Object.entries(messageObject)) {
            messageString += '&bull; '+ value + '<br>'
        }
        toastr.error(messageString, title);
    }else{
        // response is not json
        toastr.error(message, title);
    }
};

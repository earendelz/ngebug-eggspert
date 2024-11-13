import './bootstrap';

// resources/js/app.js or any JavaScript file included in your layout
$(document).ajaxSend(function(e, xhr, options) {
    var token = $("meta[name='csrf-token']").attr("content");  // Retrieve CSRF token from meta tag
    if (token) {
        xhr.setRequestHeader('X-CSRF-TOKEN', token); // Add CSRF token to the header
    }
});

/**
 * Shared behaviour for every admin page.
 */

// Send the CSRF token with every AJAX request.
$.ajaxSetup({
    headers: { 'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') },
});

/** Shows the server's error message for a failed AJAX request. */
window.showAjaxError = function (xhr) {
    const message = (xhr.responseJSON && xhr.responseJSON.message) || 'Something went wrong. Please try again.';
    toastr.error(message);
};

$(function () {
    $('.js-datatable').DataTable();

    // Generic delete button: <button class="js-delete" data-url="..." data-id="..." data-name="...">
    $(document).on('click', '.js-delete', function () {
        const $button = $(this);

        Swal.fire({
            title: `Delete ${$button.data('name')}?`,
            text: 'This cannot be undone.',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
            confirmButtonColor: '#e74a3b',
            reverseButtons: true,
        }).then(function (result) {
            if (!result.value) {
                return;
            }
            $.post($button.data('url'), { id: $button.data('id') })
                .done(function () { window.location.reload(); })
                .fail(window.showAjaxError);
        });
    });
});

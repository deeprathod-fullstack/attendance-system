/**
 * Switch a past attendance record between present and absent.
 */
$(document).on('click', '.js-toggle-attendance', function () {
    const $button = $(this);
    const newStatus = Number($button.data('present')) === 1 ? 'absent' : 'present';

    Swal.fire({
        title: `Mark as ${newStatus}?`,
        text: `Change the attendance for ${$button.data('date')}.`,
        type: 'question',
        showCancelButton: true,
        confirmButtonText: `Yes, mark ${newStatus}`,
        reverseButtons: true,
    }).then(function (result) {
        if (!result.value) {
            return;
        }
        $.post('attendance_toggle.php', { id: $button.data('id') })
            .done(function () { window.location.reload(); })
            .fail(window.showAjaxError);
    });
});

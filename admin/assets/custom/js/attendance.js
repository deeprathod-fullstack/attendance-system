/**
 * Take attendance one student at a time. The server always returns the next
 * student who has not been marked yet for the selected date.
 */
$(function () {
    const $panel = $('#attendance-panel');
    if (!$panel.length) {
        return;
    }

    const date = $panel.attr('data-date');
    const $buttons = $('.js-mark');
    let student = null;

    function warnBeforeLeaving(event) {
        event.preventDefault();
        event.returnValue = '';
    }

    function setUnsaved(unsaved) {
        window.removeEventListener('beforeunload', warnBeforeLeaving);
        if (unsaved) {
            window.addEventListener('beforeunload', warnBeforeLeaving);
        }
    }

    function render(response) {
        $('#attendance-loading').addClass('d-none');

        if (response.done) {
            student = null;
            $('#attendance-student').addClass('d-none');
            $('#attendance-done').removeClass('d-none');
            setUnsaved(false);
            return;
        }

        student = response.student;
        $('#student-name').text(student.name);
        $('#student-roll').text(student.id);
        $('#student-photo').attr({ src: student.photo, alt: student.name });
        $('#remaining-count').text(response.remaining);
        $('#attendance-student').removeClass('d-none');
        setUnsaved(true);
    }

    function loadNext() {
        $buttons.prop('disabled', true);

        return $.getJSON('attendance_api.php', { action: 'next', date: date })
            .done(render)
            .fail(window.showAjaxError)
            .always(function () { $buttons.prop('disabled', false); });
    }

    function mark(isPresent) {
        if (student === null) {
            return;
        }
        const marked = student;
        $buttons.prop('disabled', true);

        $.post('attendance_api.php', { action: 'mark', date: date, student_id: marked.id, is_present: isPresent })
            .done(function () {
                const notify = isPresent ? toastr.success : toastr.error;
                notify(`${marked.name} (Roll No ${marked.id}) marked ${isPresent ? 'present' : 'absent'}.`);
            })
            .fail(window.showAjaxError)
            .always(loadNext);
    }

    $buttons.on('click', function () {
        mark(Number($(this).data('present')));
    });

    // Keyboard shortcuts: P = present, A = absent.
    $(document).on('keydown', function (event) {
        if (event.ctrlKey || event.metaKey || event.altKey || !event.key
            || $(event.target).is('input, textarea, select') || $buttons.prop('disabled')) {
            return;
        }
        const key = event.key.toLowerCase();
        if (key === 'p') {
            mark(1);
        } else if (key === 'a') {
            mark(0);
        }
    });

    loadNext();
});

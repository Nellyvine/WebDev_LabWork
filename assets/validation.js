/* ============================================================
   TASK 2 — Form validation
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

    var form = document.getElementById('memberForm');
    if (!form) { return; }

    var FIELDS = ['full_name', 'email', 'phone', 'role', 'fee_paid', 'date_joined'];

    /* ---------- helpers ---------- */

    function showError(fieldId, message) {
        var field = document.getElementById(fieldId);
        var box   = document.getElementById('err_' + fieldId);
        if (field) { field.classList.add('invalid'); }
        if (box)   { box.textContent = message; }
    }

    function clearError(fieldId) {
        var field = document.getElementById(fieldId);
        var box   = document.getElementById('err_' + fieldId);
        if (field) { field.classList.remove('invalid'); }
        if (box)   { box.textContent = ''; }
    }

    function val(fieldId) {
        var field = document.getElementById(fieldId);
        return field ? field.value.trim() : '';
    }

    function today() {
        var d = new Date();
        var m = String(d.getMonth() + 1).padStart(2, '0');
        var day = String(d.getDate()).padStart(2, '0');
        return d.getFullYear() + '-' + m + '-' + day;
    }

    /* ---------- the checks ---------- */

    function validate() {
        var errors = [];

        FIELDS.forEach(clearError);

        /* 2-1 full name */
        var name = val('full_name');
        if (name === '' || name.length < 3 || !/^[A-Za-z\s]+$/.test(name)) {
            showError('full_name', "Enter the member's full name (letters only).");
            errors.push('full_name');
        }

        /* 2-2 email */
        var email = val('email');
        if (email === '' || !/^[^\s@]+@[^\s@]+\.[A-Za-z]{2,}$/.test(email)) {
            showError('email', 'Enter a valid email, e.g. name@school.mu');
            errors.push('email');
        }

        /* 2-3 phone */
        var phone = val('phone');
        if (!/^5\d{7}$/.test(phone)) {
            showError('phone', 'Phone must be 8 digits starting with 5.');
            errors.push('phone');
        }

        /* 2-4 role */
        if (val('role') === '') {
            showError('role', 'Choose a role.');
            errors.push('role');
        }

        /* 2-5 fee */
        var fee = val('fee_paid');
        if (fee === '' || isNaN(fee) || Number(fee) < 0 || Number(fee) > 5000) {
            showError('fee_paid', 'Fee must be between 0 and 5000.');
            errors.push('fee_paid');
        }

        /* 2-6 date joined */
        var joined = val('date_joined');
        if (joined === '' || joined > today()) {
            showError('date_joined', 'Date joined cannot be in the future.');
            errors.push('date_joined');
        }

        return errors;
    }

    /* ---------- wiring ---------- */

    /* 2-7 block the submit and focus the first bad field */
    form.addEventListener('submit', function (e) {
        var errors = validate();
        if (errors.length > 0) {
            e.preventDefault();
            document.getElementById(errors[0]).focus();
        }
    });

    /* 2-8 clear an error as soon as the user edits that field */
    FIELDS.forEach(function (id) {
        var field = document.getElementById(id);
        if (!field) { return; }
        var evt = field.tagName === 'SELECT' ? 'change' : 'input';
        field.addEventListener(evt, function () { clearError(id); });
    });

});

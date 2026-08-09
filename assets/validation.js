/* ============================================================
   TASK 2 — Form validation
   Complete every TODO. Do not delete the helper functions.
   ============================================================ */

document.addEventListener('DOMContentLoaded', function () {

    var form = document.getElementById('memberForm');
    if (!form) { return; }

    /* ---------- helpers (already written for you) ---------- */

    // Show an error message under a field and mark the field red.
    function showError(fieldId, message) {
        var field = document.getElementById(fieldId);
        var box   = document.getElementById('err_' + fieldId);
        if (field) { field.classList.add('invalid'); }
        if (box)   { box.textContent = message; }
    }

    // Remove the error from one field.
    function clearError(fieldId) {
        var field = document.getElementById(fieldId);
        var box   = document.getElementById('err_' + fieldId);
        if (field) { field.classList.remove('invalid'); }
        if (box)   { box.textContent = ''; }
    }

    // Read a field's value with spaces trimmed off both ends.
    function val(fieldId) {
        var field = document.getElementById(fieldId);
        return field ? field.value.trim() : '';
    }

    // Today's date as YYYY-MM-DD, so you can compare it to date_joined.
    function today() {
        var d = new Date();
        var m = String(d.getMonth() + 1).padStart(2, '0');
        var day = String(d.getDate()).padStart(2, '0');
        return d.getFullYear() + '-' + m + '-' + day;
    }

    /* ---------- the checks ---------- */

    function validate() {
        var errors = [];   // push the id of each field that fails

        ['full_name', 'email', 'phone', 'role', 'fee_paid', 'date_joined']
            .forEach(clearError);

        // TODO 2-1: full_name — required, at least 3 characters,
        //           letters and spaces only.
        //           Message: Enter the member's full name (letters only).

        // TODO 2-2: email — required and a valid email address.
        //           Message: Enter a valid email, e.g. name@school.mu

        // TODO 2-3: phone — required, exactly 8 digits, first digit is 5.
        //           Message: Phone must be 8 digits starting with 5.

        // TODO 2-4: role — something other than the empty placeholder
        //           must be chosen.
        //           Message: Choose a role.

        // TODO 2-5: fee_paid — required, a number, between 0 and 5000.
        //           Message: Fee must be between 0 and 5000.

        // TODO 2-6: date_joined — required and not later than today().
        //           Message: Date joined cannot be in the future.

        return errors;
    }

    /* ---------- wiring ---------- */

    form.addEventListener('submit', function (e) {
        var errors = validate();

        // TODO 2-7: if there is at least one error, stop the form from
        //           submitting and put the cursor in the FIRST bad field.
    });

    // TODO 2-8: when the user types in any field, clear that field's error.
    //           Listen for the 'input' event on inputs and 'change' on the
    //           select.

});

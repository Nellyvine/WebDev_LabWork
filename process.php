<?php
require 'config.php';
require 'auth.php';
require_login();

/*
 * TASK 3b — Create and Update with MySQLi.
 * form.php posts here. When 'id' is empty it is a NEW member (INSERT).
 * When 'id' has a value it is an EXISTING member (UPDATE).
 *
 * Never trust the browser: the JavaScript can be switched off, so check
 * the values again here before touching the database.
 *
 * Reminder — the bind_param type string:
 *   s = string    i = integer    d = decimal/double
 * One letter per ?, in the same order as the values.
 */

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id          = trim($_POST['id'] ?? '');
$full_name   = trim($_POST['full_name'] ?? '');
$email       = trim($_POST['email'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$role        = trim($_POST['role'] ?? '');
$fee_paid    = trim($_POST['fee_paid'] ?? '');
$date_joined = trim($_POST['date_joined'] ?? '');

// TODO 3b-2: if any of the six values above is empty, set a warning flash
//            and send the user back to form.php.
// Done
/*
 * TASK 3b-2: server-side validation. This is the real security
 * boundary — client-side JS can be disabled, so nothing here can
 * be trusted until it's checked again on the server.
 */

if ($full_name === '' || $email === '' || $phone === '' || $role === '' || $fee_paid === '' || $date_joined === '') {
    set_flash('Please fill in every field.', 'warn');
    header('Location: form.php' . ($id !== '' ? '?id=' . (int)$id : ''));
    exit;
}

if ($id === '') {
    // TODO 3b-3: INSERT a new member.
    //            $stmt = $conn->prepare('INSERT INTO members (...) VALUES (?, ?, ...)');
    //            $stmt->bind_param('...', ...);
    //            $stmt->execute();
    //            Then set_flash('Member added.') and redirect to index.php.
    // Done
    // TASK 3b-3: id is empty -> this is a brand new member -> INSERT

    $stmt = $conn->prepare(
        'INSERT INTO members (full_name, email, phone, role, fee_paid, date_joined)
         VALUES (?, ?, ?, ?, ?, ?)'
    );
    $stmt->bind_param('ssssds', $full_name, $email, $phone, $role, $fee_paid, $date_joined);
    $stmt->execute();
    set_flash('Member added.');
    header('Location: index.php');
    exit;
} else {
    // TODO 3b-4: UPDATE the member whose id matches. Remember the id is the
    //            LAST ? in the query, so it is the last letter in the type
    //            string and the last value in bind_param.
    //            Then set_flash('Member updated.') and redirect.
    // Done
    // TASK 3b-4: id has a value -> this is an existing member -> UPDATE


    $id_int = (int)$id;
    $stmt = $conn->prepare(
        'UPDATE members
         SET full_name = ?, email = ?, phone = ?, role = ?, fee_paid = ?, date_joined = ?
         WHERE id = ?'
    );
    $stmt->bind_param('ssssdsi', $full_name, $email, $phone, $role, $fee_paid, $date_joined, $id_int);
    $stmt->execute();
    set_flash('Member updated.');
    header('Location: index.php');
    exit;
}

// set_flash('Member added.') is a command used in web programming to store a temporary notification 
// message - known as a "flash message" - in the user's session.
//  The message "Member added." will display once on the next page the user sees, and then it will automatically disappear.
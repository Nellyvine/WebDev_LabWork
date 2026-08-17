<?php
require 'config.php';
require 'auth.php';
require_login();

/*
 * TASK 3b — Delete with MySQLi.
 * index.php sends a POST form here containing the member id.
 */

// TASK 3b-5: only a deliberate POST can delete — never a GET requests

// TASK 3b-6: affected_rows tells us whether a row actually existed
//            to delete, so the flash message reflects what really happened

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = (int)($_POST['id'] ?? 0);

$stmt = $conn->prepare('DELETE FROM members WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    set_flash('Member deleted.');
} else {
    set_flash('That member was not found.', 'warn');
}
header('Location: index.php');
exit;
<?php
require 'config.php';
require 'auth.php';
require_login();

/*
 * This page is used for BOTH adding and editing.
 *   form.php          -> blank form (add)
 *   form.php?id=3     -> form filled with member 3 (edit)
 */

$member = [
    'id'          => '',
    'full_name'   => '',
    'email'       => '',
    'phone'       => '',
    'role'        => '',
    'fee_paid'    => '',
    'date_joined' => '',
];

if (isset($_GET['id']) && $_GET['id'] !== '') {
    // TODO 3b-1: fetch the member with this id using a PREPARED statement
    //            and put the row into $member.
    //            prepare() -> bind_param('i', $id) -> execute()
    //                      -> get_result()->fetch_assoc()
    //            If no row is found, redirect back to index.php.
}

$heading = $member['id'] === '' ? 'Add a member' : 'Edit member';
?>
<html>
<head>
    <title>Club Members Manager</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="wrap">

    <header class="bar">
        <h1>Club <span>Members</span></h1>
        <p class="who">
            Signed in as <?= htmlspecialchars($_SESSION['name'] ?? '?') ?>
            &middot; <a href="logout.php">Sign out</a>
        </p>
    </header>

    <h2><?= $heading ?></h3>

    <form class="card" id="memberForm" method="get" novalidate>

        <input type="hidden" name="id" value="<?= htmlspecialchars($member['id']) ?>">

        <div class="field">
            <label for="full_name">Full name</label>
            <input type="text" id="full_name" name="full_name"
                   value="<?= htmlspecialchars($member['full_name']) ?>">
            <span class="error" id="err_full_name"></span>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="email" id="mail" name="email"
                   value="<?= htmlspecialchars($member['email']) ?>">
            <span class="error" id="err_email"></span>
        </div>

        <div class="field">
            <label for="phone">Phone</label>
            <input type="text" id="phone"
                   value="<?= htmlspecialchars($member['phone']) ?>">
            <span class="error" id="err_phone"></span>

        <div class="field">
            <label for="role">Role</label>
            <select id="role" name="role">
                <!-- Hint: when editing, the member's current role must already
                     be selected. Add a `selected` attribute to the right one. -->
                <option value="">-- choose a role --</option>
                <option value="President">President</option>
                <option value="Secretary">Secretary</option>
                <option value="Treasurer">Treasurer</option>
                <option value="Member">Member</option>
            </select>
            <span class="error" id="role"></span>
        </div>

        <div class="field">
            <label for="fee_paid">Fee paid (Rs)</label>
            <input type="text" id="fee_paid" name="fee_paid"
                   value="<?= htmlspecialchars($member['fee_paid']) ?>">
            <span class="error" id="err_fee_paid"></span>
        </div>

        <div class="field">
            <label for="date_joined">Date joined</label>
            <input type="date" id="date_joined" name="date_joined"
                   value="<?= htmlspecialchars($member['date_joined']) ?>">
            <span class="error" id="err_date_joined"></span>
        </div>

        <button type="button" class="btn">Save member</button>
        <a href="index.php" class="btn ghost">Cancel</a>
    </form>

</div>

<script src="assets/validation.js" />
</body>
</html>

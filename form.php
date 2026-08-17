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

/* 3b-1 — load the row when editing */
if (isset($_GET['id']) && $_GET['id'] !== '') {
    $id   = (int)$_GET['id'];
    $stmt = $conn->prepare('SELECT * FROM members WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$row) {
        set_flash('That member was not found.', 'warn');
        header('Location: index.php');
        exit;
    }
    $member = $row;
}

$heading = $member['id'] === '' ? 'Add a member' : 'Edit member';
$roles   = ['President', 'Secretary', 'Treasurer', 'Member'];
?>

<!DOCTYPE html>                                   <!-- FIX 1 -->
<html lang="en">
<head>
    <meta charset="UTF-8">                        <!-- FIX 2 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <h2><?= $heading ?></h2>   <!--  Fixed: I changed </h3> to </h2> > -->

    <!-- FIxed: I added action so form now posts to process.php -->

    <form class="card" id="memberForm" method="post" action="process.php" novalidate>

        <input type="hidden" name="id" value="<?= htmlspecialchars($member['id']) ?>">

        <div class="field">
            <label for="full_name">Full name</label>
            <input type="text" id="full_name" name="full_name"
                   value="<?= htmlspecialchars($member['full_name']) ?>">
            <span class="error" id="err_full_name"></span>
        </div>

        <div class="field">
            <label for="email">Email</label>
            <!-- FIX 6: id now matches the label's for -->
            <input type="email" id="email" name="email"
                   value="<?= htmlspecialchars($member['email']) ?>">
            <span class="error" id="err_email"></span>
        </div>

        <div class="field">
            <label for="phone">Phone</label>
            <!-- FIX 7: name added, or PHP never receives the phone -->
            <input type="text" id="phone" name="phone"
                   value="<?= htmlspecialchars($member['phone']) ?>">
            <span class="error" id="err_phone"></span>
        </div>                                     <!-- FIX 4: closing div -->

        <div class="field">
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="">-- choose a role -- </option>

                <!-- $roles is the array defined near the top of the file, $role doesn't exist  -->
                <?php foreach ($roles as $r): ?>
                    <option value= "<?= $r ?>"
                        <?= $member['role'] === $r ? 'selected' : ''?>>
                        <?= $r ?>
                    </option>
                <?php endforeach ?>
            </select>
            <!-- FIX 8: id was a duplicate of the select's id -->
            <span class="error" id="err_role"></span>
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

        <!-- FIX 9: type="button" never submits -->
        <button type="submit" class="btn">Save member</button>
        <a href="index.php" class="btn ghost">Cancel</a>
    </form>

</div>

<!-- FIX 10: a script tag cannot be self-closed -->
<script src="assets/validation.js"></script>
</body>
</html>

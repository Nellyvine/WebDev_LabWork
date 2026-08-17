<?php
require 'config.php';
require 'auth.php';
require_login();

// TODO 3b-0: fetch every member from the database, newest first, into
//            $members. There is no user input in this query, so $conn->query()
//            is enough here — then loop with while ($row = $result->fetch_assoc()).
// Done 
// TASK 3b-0: no user input here, so a plain query() is safe and sufficient

$members = [];
$result  = $conn->query('SELECT * FROM members ORDER BY id DESC');
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

$flash = take_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Members — Club Members Manager</title>
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

    <?php if ($flash): ?>
        <p class="flash <?= $flash['type'] === 'ok' ? '' : 'warn' ?>">
            <?= htmlspecialchars($flash['msg']) ?>
        </p>
    <?php endif; ?>

    <div class="toolbar">
        <span><?= count($members) ?> member(s) on the list</span>
        <a href="form.php" class="btn">Add a member</a>
    </div>

    <table>
        <caption>Club member register</caption>
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
                <th scope="col">Fee</th>
                <th scope="col">Joined</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!$members): ?>
            <tr>
                <td colspan="7" class="empty">
                    No members yet. Use <strong>Add a member</strong> to start
                    the list.
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($members as $m): ?>
            <tr>
                <td><?= htmlspecialchars($m['full_name']) ?></td>
                <td><?= htmlspecialchars($m['email']) ?></td>
                <td><?= htmlspecialchars($m['phone']) ?></td>
                <td><?= htmlspecialchars($m['role']) ?></td>
                <td class="num">Rs <?= number_format((float)$m['fee_paid'], 2) ?></td>
                <td><?= htmlspecialchars($m['date_joined']) ?></td>
                <td class="actions">
                    <a class="btn small ghost"
                       href="form.php?id=<?= (int)$m['id'] ?>">Edit</a>

                    <form method="post" action="delete.php" style="display:inline"
                          onsubmit="return confirm('Delete this member?');">
                        <input type="hidden" name="id" value="<?= (int)$m['id'] ?>">
                        <button type="submit" class="btn small danger">Delete</button>
                    </form>

                    <!-- TODO 3b-7: a small POST form that sends this member's
                         id to delete.php, with an onsubmit confirmation. -->
                    <!-- Done -->
                    <!-- TASK 3b-7: delete must be POST (not a GET link) so it can't be
                        triggered accidentally by prefetching or crawling; confirm() adds a manual safety check --> 

                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>
</body>
</html>

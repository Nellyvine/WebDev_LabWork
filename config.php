<?php
/*
 * Database connection with MySQLi. This file is already done for you.
 * Change $pass below if your MySQL root account has a password.
 */

$host = 'localhost';
$db   = 'club_db';
$user = 'root';
$pass = '';

// Make MySQLi throw an error instead of failing silently.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Cannot reach the database: ' . $e->getMessage());
}

/* The only accounts that can sign in. Password is: admin123 */
$USERS = [
    'admin' => [
        'name' => 'Club Admin',
        'hash' => '$2y$10$c26PQpkvCxy3bcVWNRMqLuf.Df4NR8pxP9lOGMkoB1moKyTpoEETK',
    ],
];

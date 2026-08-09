<?php
require 'config.php';
require 'auth.php';
require_login();

/*
 * TASK 3b — Delete with MySQLi.
 * index.php sends a POST form here containing the member id.
 */

// TODO 3b-5: refuse anything that is not a POST request
//            (redirect back to index.php).

// TODO 3b-6: delete the row with this id using prepare() + bind_param('i', $id)
//            + execute(). Check $stmt->affected_rows to decide which flash
//            message to show, then redirect to index.php.

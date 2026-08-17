<?php
/*
 * TASK 3a — sessions.
 * Every page except login.php includes this file and calls require_login().
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Stop the page and send the visitor to login.php when nobody is signed in.
 */

function require_login()
{

    if (!isset($_SESSION['user'])){
        header('location: login.php');
        exit;
    }
}

/**
 * Store a one-time message that the next page will show, then forget it.
 * (Already written — use it after every add / update / delete.)
 */

function set_flash($message, $type = 'ok')
{
    $_SESSION['flash'] = ['msg' => $message, 'type' => $type];
}

function take_flash()
{
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

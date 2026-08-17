<!--  TASK 3a-5: log out = clear all session data, then destroy the
 session on the server, then send the user back to the login page. -->


<?php
require 'auth.php';

$_SESSION = [];
session_destroy();
header('Location: login.php');
exit;
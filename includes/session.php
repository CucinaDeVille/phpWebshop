<?php

session_start();

$timeout = 600; // 10 minutes

if (isset($_SESSION['last_activity'])) {

    // if more than 10 minutes have passed user is logged out
    if (time() - $_SESSION['last_activity'] > $timeout) {
        session_unset();
        session_destroy();
    }
}

$_SESSION['last_activity'] = time();
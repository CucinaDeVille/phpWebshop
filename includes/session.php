<?php

session_start();

$timeout = 600;

if (isset($_SESSION['last_activity'])) {

    if (time() - $_SESSION['last_activity'] > $timeout) {

        session_unset();
        session_destroy();

    }

}

$_SESSION['last_activity'] = time();
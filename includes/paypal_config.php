<?php

define('PAYPAL_ID', 'schlager.seller@hs-offenburg.de');

define('PAYPAL_SANDBOX', true);

define('PAYPAL_URL', PAYPAL_SANDBOX
        ? 'https://www.sandbox.paypal.com/cgi-bin/webscr'
        : 'https://www.paypal.com/cgi-bin/webscr'
);

define(
    'PAYPAL_RETURN_URL',
    'http://localhost:8080/actions/paypal_success.php'
);

define(
    'PAYPAL_CANCEL_URL',
    'http://localhost:8080/actions/paypal_cancel.php'
);

define('PAYPAL_CURRENCY', 'EUR');

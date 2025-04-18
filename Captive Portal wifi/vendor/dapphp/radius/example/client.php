<?php

/**
 * RADIUS client example using PAP password.
 */

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

require_once __DIR__ . '/../autoload.php';

$radius = new \Dapphp\Radius\Radius();
$radius->setServer('10.17.76.42')        // IP or hostname of RADIUS server
       ->setSecret('asupersecert123!')       // RADIUS shared secret
       ->setNasIpAddress('')  // IP or hostname of NAS (device authenticating user)
       ->setAttribute(32, '')       // NAS identifier
       ->setDebug();                   // Enable debug output to screen/console

// Send access request for a user with username = 'username' and password = 'password!'
$response = $radius->accessRequest('101', '101');

if ($response === false) {
    // false returned on failure
    echo sprintf("Access-Request failed with error %d (%s).\n",
        $radius->getErrorCode(),
        $radius->getErrorMessage()
    );
} else {
    // access request was accepted - client authenticated successfully
    echo "Success!  Received Access-Accept response from RADIUS server.\n";
}

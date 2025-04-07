<?php
require 'vendor/autoload.php'; // Make sure to install dapphp/radius via composer

use Dapphp\Radius\Radius;

$server = '10.17.76.42';
$secret = 'asupersecert123!';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$radius = new Radius($server, $secret);

if ($radius->accessRequest($username, $password)) {
    // Display success message before redirecting
    echo "<html><head>
            <meta http-equiv='refresh' content='3;url=https://search.somedomain.net'>
          </head><body>
          <div style='display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; font-family: Arial, sans-serif;'>
              <div>
                  <h2 style='color: #4A00E0;'>Authentication Successful!</h2>
                  <p style='color: #333;'>You will be redirected shortly...</p>
                  <p>If you are not redirected, <a href='https://search.somedomain.net'>click here</a>.</p>
              </div>
          </div>
          </body></html>";    exit();
} else {
    echo "Invalid credentials. Please try again.";
}
?>

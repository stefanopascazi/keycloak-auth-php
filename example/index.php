<?php
session_start();
require __DIR__ . "/vendor/autoload.php";

use KeycloakLibrary\KeycloakAuthPhp\Keycloak;

Keycloak::init(
    json_decode('{
      "realm": "myrealm",
      "auth-server-url": "https://your-keycloak-domain.com/",
      "ssl-required": "external",
      "resource": "myclient",
      "public-client": true,
      "confidential-port": 0
  }', true), "https://your-app-domain.com/auth.php");
    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test SSO with sample client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col">
                <h1>Test SSO with sample client</h1>
                <ul>
                    <?php if( isset($_SESSION['access_token']) ) : ?>            
                        <li><a href="/profile.php">Profile</a></li>
                        <li><a href="<?php echo Keycloak::account("https://your-app-domain.com/")->getUrl(); ?>">Account</a></li>
                        <li><a href="/logout.php">Logout</a></li>
                    <?php else : ?>
                        <li><a href="<?php echo Keycloak::auth()->createLoginString(); ?>">Login | Register</a></li>
                    <?php endif; ?>
                </ul>
              </div>
          </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
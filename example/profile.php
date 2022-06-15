<?php
session_start();
if( !isset( $_SESSION['access_token']) )
{
    header("Location: /");
}
require "../vendor/autoload.php";

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

$data = Keycloak::user($_SESSION['access_token'])->getInfo();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile | Test SSO with sample client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col">
                <h1>Test SSO with sample client</h1>
                <ul>     
                    <li><a href="/">Home</a></li>
                    <li><a href="/logout.php">Logout</a></li>
                </ul>
              </div>
          </div>
          <div class="row">
              <div class="col">
                <ul>
                    <li>ID:
                        <?php echo $data['sub']; ?>
                    </li>
                    <li>name:
                        <?php echo $data['name']; ?>
                    </li>
                    <li>email:
                        <?php echo $data['email']; ?>
                    </li>
                </ul>
              </div>
          </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
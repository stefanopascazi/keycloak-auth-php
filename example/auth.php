<?php
session_start();
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

$response = Keycloak::auth()->getToken($_GET['code']);
$_SESSION['access_token'] = $response['access_token'];
$_SESSION['refresh_token'] = $response['refresh_token'];
header("Location: /");

//

//var_dump(
//   Keycloak::user($response['access_token'])->getInfo()
// );
<?php
session_start();
if( !isset( $_SESSION['refresh_token']) )
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
    
Keycloak::auth()->logout($_SESSION['refresh_token']);

session_destroy();
$_SESSION = [];
header("Location: /");

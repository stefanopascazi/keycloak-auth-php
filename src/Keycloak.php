<?php

namespace KeycloakLibrary\KeycloakAuthPhp;

class Keycloak
{

    static array $config = [];

    static string $redirect = "";

    public static function init(array $config, string $redirect)
    {
        Keycloak::$config = $config;

        Keycloak::$redirect = $redirect;
    }

    public static function account( string $redirect = "" ) : \KeycloakLibrary\KeycloakAuthPhp\Classes\Account
    {
        $args = new \KeycloakLibrary\KeycloakAuthPhp\Classes\Account(
            Keycloak::$config, $redirect
        );

        return $args;
    }
}
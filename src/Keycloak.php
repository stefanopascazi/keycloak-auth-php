<?php

namespace KeycloakLibrary\KeycloakAuthPhp;

use KeycloakLibrary\KeycloakAuthPhp\Interface\IKeycloak;
use KeycloakLibrary\KeycloakAuthPhp\bootstrap\Account;
use KeycloakLibrary\KeycloakAuthPhp\bootstrap\Auth;
use KeycloakLibrary\KeycloakAuthPhp\bootstrap\User;

class Keycloak implements IKeycloak
{

    static array $config = [];

    static string $redirect = "";

    public static function init(array $config, string $redirect) : void
    {
        Keycloak::$config = $config;

        Keycloak::$redirect = $redirect;
    }

    public static function account( string $redirect = "" ) : Account
    {
        $Account = new Account(
            Keycloak::$config, $redirect
        );

        return $Account;
    }

    public static function auth() : Auth
    {
        $Auth = new Auth(
            Keycloak::$config, Keycloak::$redirect
        );

        return $Auth;
    }

    public static function user(string $token) : User
    {
        $User = new User(
            Keycloak::$config, $token
        );

        return $User;
    }
}
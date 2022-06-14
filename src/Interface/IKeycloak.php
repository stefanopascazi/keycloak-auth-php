<?php

namespace KeycloakLibrary\KeycloakAuthPhp\Interface;

use KeycloakLibrary\KeycloakAuthPhp\bootstrap\Account;
use KeycloakLibrary\KeycloakAuthPhp\bootstrap\Auth;

interface IKeycloak
{
    public static function init(array $config, string $redirect) : void;

    public static function account( string $redirect = "" ) : Account;

    public static function auth() : Auth;
}
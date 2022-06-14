<?php

namespace KeycloakLibrary\KeycloakAuthPhp\Interface;

interface IAuth
{

    public function createLoginString( string $responsemode = "query" ) : string;

    public function createRegistrationString( string $responsemode = "query" ) : string;

    public function getToken( string $code, bool $refresh = false ) : array;

    public function logout( string $refreshtoken ) : bool;
}
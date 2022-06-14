<?php

namespace KeycloakLibrary\KeycloakAuthPhp\bootstrap;

use KeycloakLibrary\KeycloakAuthPhp\Interface\IAuth;
use Symfony\Component\HttpClient\HttpClient;

class Auth implements IAuth
{
    protected array $config;

    protected string $redirect;

    protected array $headers = [];

    protected string $getTokenUrl;

    protected string $getUserinfoUrl;

    protected string $getLogoutUrl;


    public function __construct(array $config, string $redirect = "")
    {
        $this->config = $config;
        $this->redirect = $redirect;

        $this->headers = [
            "Content-Type" => "applucation/x-www-form-urlencoded"
        ];

        $this->getTokenUrl = "{$this->config['auth-server-url']}realms/{$this->config['realm']}/protocol/openid-connect/token";
        $this->getUserinfoUrl = "{$this->config['auth-server-url']}realms/{$this->config['realm']}/protocol/openid-connect/userinfo";
        $this->getLogoutUrl = "{$this->config['auth-server-url']}realms/{$this->config['realm']}/protocol/openid-connect/logout";
    }

    public function createLoginString( string $responsemode = "query" ) : string
    {
        $redirect = "";
        if( $this->redirect !== "" )
        {
            $redirect = "&redirect_uri={$this->redirect}";
        }

        return "{$this->config['auth-server-url']}realms/{$this->config['realm']}/protocol/openid-connect/auth?client_id={$this->config['resource']}{$redirect}&response_mode={$responsemode}&response_type=code&scope=web-origins";
    }

    public function createRegistrationString( string $responsemode = "query" ) : string
    {
        $redirect = "";
        if( $this->redirect !== "" )
        {
            $redirect = "&redirect_uri={$this->redirect}";
        }

        return "{$this->config['auth-server-url']}realms/{$this->config['realm']}/protocol/openid-connect/registrations?client_id={$this->config['resource']}{$redirect}&response_mode={$responsemode}&response_type=code&scope=web-origins";
    }

    public function getToken( string $code, bool $refresh = false ) : array
    {
        (array)$formData = [];

        $formData = [
            'grant_type' => $refresh ? "refresh_token" : "authorization_code",
            "client_id" => $this->config['resource'],
            $refresh ? "refresh_token" : "code" => $code,
            "redirect_uri" => $this->redirect
        ];

        if( isset( $this->config['credentials'] ) )
        {
            $formData["client_secret"] = $this->config['credentials']['secret'];
        }

        $client = HttpClient::create();
        $response = $client->request("POST", $this->getTokenUrl, [
            "body" => $formData
        ]);

        return $response->toArray();
        
    }

    public function logout( string $refreshtoken ) : bool
    {
        (array)$formData = [
            'refresh_token' => $refreshtoken,
            "client_id" => $this->config['resource']
        ];

        if( isset( $this->config['credentials'] ) )
        {
            $formData["client_secret"] = $this->config['credentials']['secret'];
        }

        $client = HttpClient::create();
        $response = $client->request("POST", $this->getLogoutUrl, [
            "body" => $formData
        ]);

        return true;
    }
}
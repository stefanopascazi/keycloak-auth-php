<?php

namespace KeycloakLibrary\KeycloakAuthPhp\bootstrap;

use KeycloakLibrary\KeycloakAuthPhp\Interface\IUser;
use Symfony\Component\HttpClient\HttpClient;

class User implements IUser
{
    protected array $config;

    protected string $token;

    protected array $headers = [];

    protected string $getUserinfoUrl;


    public function __construct(array $config, string $token = "")
    {
        $this->config = $config;
        $this->token = $token;

        $this->headers = [
            "Accept" => "*",
            "Authorization" => "Bearer {$token}"
        ];

        $this->getUserinfoUrl = "{$this->config['auth-server-url']}realms/{$this->config['realm']}/protocol/openid-connect/userinfo";
    }
    
    public function getInfo(): array
    {
        $client = HttpClient::create();
        $response = $client->request("POST", $this->getUserinfoUrl, [
            "headers" => $this->headers
        ]);

        return $response->toArray();
    }
}
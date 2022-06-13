<?php

namespace KeycloakLibrary\KeycloakAuthPhp\Classes;

class Account
{

    protected array $config = [];

    protected string $redirect = "";

    public  function __construct(array $config, string $redirect)
    {
        $this->config = $config;

        $this->redirect = $redirect;
    }

    public function getUrl()
    {
        $redirect = "";
        if( $this->redirect !== "" )
        {
            $redirect = "?referrer={$this->config['resource']}&referrer_uri={$this->redirect}";
        }
        return "{$this->config['auth-server-url']}realms/{$this->config['realm']}/account/{$redirect}";
    }
}
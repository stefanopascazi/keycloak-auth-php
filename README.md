# keycloak-auth-php
Beautifull and fast module for authenticate with OAuth2 use Keycloak.


```php
<?php
session_start();
require __DIR__ . "/vendor/autoload.php";

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
    
echo Keycloak::auth()->createLoginString();
?>
```

## Installation

This is a **PHP** module available through the packagist registry.

Before installing, **download and install PHP**. PHP 8.0.2 or higher is required.

If this is a brand new project, make sure to create a composer.json first with the **composer init command**.

Installation is done using the **composer require command**:

```bash
$ composer require stefanopascazi/keycloak-auth-php`
```
## Example
[https://github.com/stefanopascazi/keycloak-auth-php/tree/main/example](https://github.com/stefanopascazi/keycloak-auth-php/tree/main/example)
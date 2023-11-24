# install laravel:
composer create-project laravel/laravel authentication

# jwt authentication:

composer require tymon/jwt-auth

Add the service provider to the providers array in the config/app.php config file as follows: 
'providers' => [ Tymon\JWTAuth\Providers\LaravelServiceProvider::class, ]

Run the following command to publish the package config file:
 php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
after running this command config/jwt.php file will be added.

Generate jwt Secret key using following command:
php artisan jwt:secret

Update your User model
Firstly you need to implement the Tymon\JWTAuth\Contracts\JWTSubject contract on your User model, which requires that you implement the 2 methods getJWTIdentifier() and getJWTCustomClaims().

The example below should give you an idea of how this could look. Obviously you should make any changes necessary to suit your own needs.

<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

# Configure Auth guard
Note: This will only work if you are using Laravel 5.2 and above.

Inside the config/auth.php file you will need to make a few changes to configure Laravel to use the jwt guard to power your application authentication.

Make the following changes to the file:

'defaults' => [
    'guard' => 'api',
    'passwords' => 'users',
],

...

'guards' => [
    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
]

# Output Screenshot:


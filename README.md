# install laravel:

<pre>composer create-project laravel/laravel authentication</pre>

# jwt authentication:
<p>
    <pre>composer require tymon/jwt-auth</pre>
    
</p>


<h4>Add the service provider to the providers array in the config/app.php config file as follows: </h4>
<p><pre>'providers' => [ Tymon\JWTAuth\Providers\LaravelServiceProvider::class, ]</pre></p>

<h4>Run the following command to publish the package config file:</h4>
 <p>php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"</p>
<p>after running this command config/jwt.php file will be added.</p>

<h4>Generate jwt Secret key using following command:</h4>
<p>php artisan jwt:secret</p>


## Update your User model
<p>
Firstly you need to implement the Tymon\JWTAuth\Contracts\JWTSubject contract on your User model, which requires that you implement the 2 methods getJWTIdentifier() and getJWTCustomClaims().

The example below should give you an idea of how this could look. Obviously you should make any changes necessary to suit your own needs.
</p>

<p>
  namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
<?php
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
  
</p>



## Configure Auth guard
<p>
Note: This will only work if you are using Laravel 5.2 and above.
</p>
<p>
Inside the config/auth.php file you will need to make a few changes to configure Laravel to use the jwt guard to power your application authentication.</p>



<p>Make the following changes to the file:</p>

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

## Output Screenshot:
<ul>
  <li><strong>User Register and Send Otp:</strong>
  <img src="screenshot/register%20and%20send%20otp.png" alt="">
  
  </li>
  <br>
  <hr>

  <li><strong>User Model Database:</strong><p>
  <img src="screenshot/user%20model%20database.png" alt="">
  </li>
    <br>
  <hr>

  <li><strong>Email Verification</strong>
  <img src="screenshot/email_verified.png" alt="">
  </li>
    <br>
  <hr>

  <li><strong>After Verified Email</strong>
  <img src="screenshot/after%20verified%20email%2C%20database.png" alt="">
  </li>
    <br>
  <hr>

  <li><strong>User Login: </strong>
  <img src="screenshot/login%20api.png" alt="">
  </li>
    <br>
  <hr>
 
 <li><strong>Show Profile: </strong>
  <img src="screenshot/show%20profile%20using%20jwt%20token.png" alt="">
  </li>
<br>
<hr>
  <li><strong>Change User Password: </strong>
  <img src="screenshot/change%20password.png" alt="">
  </li>
    <br>
  <hr>

  <li><strong>Add Product is not accessible for user: </strong>
  <img src="screenshot/add%20product%20auth%20by%20admin.png" alt="">
  </li>
    <br>
  <hr>

<li><strong>Admin Login </strong>
  <img src="screenshot/admin%20login.png" alt="">
  </li>
    <br>
  <hr>

  <li><strong>Add product by admin:  </strong>
  <img src="screenshot/update%20product%20by%20admin.png" alt="">
  </li>
    <br>
  <hr>

   <li><strong>Add product by admin:  </strong>
  <img src="screenshot/update%20product%20by%20admin.png" alt="">
  </li>
    <br>
  <hr>

  <li><strong>Show Product is not accessible for unregistered user:  </strong>
  <img src="screenshot/show%20product%20not%20accessible.png" alt="">
  </li>
    <br>
  <hr>

     <li><strong>Show Product:  </strong>
  <img src="screenshot/show%20product.png" alt="">
  </li>
    <br>
  <hr>
 
</ul>

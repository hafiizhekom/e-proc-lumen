<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
            
            if($request->header('Authorization')) {
                
                $token = $request->header('Authorization');

                try {
                    $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
                } catch(ExpiredException $e) {
                    return (object) array('user' => null, 'error'=> 'Provided token is expired.', 'status'=>401);
                } catch(\Exception $e) {
                    return (object) array('user' => null, 'error'=> 'An error while decoding token.', 'status'=>400);
                }
                
                $dataUser = explode("-", $credentials->sub);

                $arrayUser = (object) array('id' => $dataUser[0], 'name'=> $dataUser[1], 'email'=> $dataUser[2]);
                return (object) array('user' => $arrayUser);
            }   

        });
    }
}

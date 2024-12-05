<?php

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades();

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->routeMiddleware([
    'login' => App\Http\Middleware\LoginMiddleware::class,
    'register' => App\Http\Middleware\RegisterMiddleware::class,
    'auth' => App\Http\Middleware\Authenticate::class,
    // 'jwt.auth' => App\Http\Middleware\JwtMiddleware::class,
    'vendor' => App\Http\Middleware\VendorMiddleware::class,
    'vendordetail' => App\Http\Middleware\VendorDetailMiddleware::class,
    'vendordokumen' => App\Http\Middleware\VendorDokumenMiddleware::class,
    'vendorkategori' => App\Http\Middleware\VendorKategoriMiddleware::class,
    'vendortipe' => App\Http\Middleware\VendorTipeMiddleware::class,
    'tender' => App\Http\Middleware\Tender::class,
    'tenderdetail' => App\Http\Middleware\TenderDetail::class,
    'tendertahap' => App\Http\Middleware\TenderTahapMiddleware::class,
    'tendermetodedokumen' => App\Http\Middleware\TenderMetodeDokumenMiddleware::class,
    'tendermetodeevaluasi' => App\Http\Middleware\TenderMetodeEvaluasiMiddleware::class,
    'tendermetodekualifikasi' => App\Http\Middleware\TenderMetodeKualifikasiMiddleware::class,
    'tendermetodepengadaan' => App\Http\Middleware\TenderMetodePengadaanMiddleware::class,
    'tendercarapembayaran' => App\Http\Middleware\TenderCaraPembayaranMiddleware::class,
    'tenderkualifikasi' => App\Http\Middleware\TenderKualifikasiMiddleware::class,
    'tenderkebutuhan' => App\Http\Middleware\TenderKebutuhan::class,
    'tenderkebutuhanbarang' => App\Http\Middleware\TenderKebutuhanBarangMiddleware::class,
    'tenderkebutuhansatuan' => App\Http\Middleware\TenderKebutuhanSatuanMiddleware::class,
    'tenderkebutuhansatuan' => App\Http\Middleware\TenderKebutuhanSatuanMiddleware::class,
    'bidtendervendor' => App\Http\Middleware\BidTenderVendorMiddleware::class,
    'bidtendertahap' => App\Http\Middleware\BidTenderTahapMiddleware::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(Krlove\EloquentModelGenerator\Provider\GeneratorServiceProvider::class);





/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;

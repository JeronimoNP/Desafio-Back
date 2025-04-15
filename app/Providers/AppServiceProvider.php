<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * O namespace para os controladores.
     *
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * Defina as rotas para o aplicativo.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        // Outras rotas podem ser registradas aqui, como as de 'web'
    }

    /**
     * Registrar as rotas da API.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));  // Carrega as rotas do arquivo api.php
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Router;

class GenerateRoutesForJavascript extends Command
{

    protected $router;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route.json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate routes for javascript.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Router $router)
    {
        parent::__construct();

        $this->router = $router;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routes = [];

        foreach ($this->router->getRoutes() as $route) {
            $routes[$route->getName()] = $route->uri();
        }

        File::put('resources/assets/js/routes.json', json_encode($routes, JSON_PRETTY_PRINT));
    }
}

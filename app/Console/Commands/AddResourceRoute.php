<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;

class AddResourceRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:route {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a resource route for the model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        // $modelName = $this->ask('Enter model name');

        // Verify if the model exists
        $modelClass = "App\\Models\\$modelName";
        if (!class_exists($modelClass)) {
            $this->error("Model $modelClass not found.");
            return;
        }

        $route = Str::plural(Str::snake($modelName));

        // Append the resource route to web.php
        $this->addResourceRouteToWeb($route, $modelName);
    }

    protected function addResourceRouteToWeb($route, $model)
    {
        $routeContent = "Route::resource('$route', " . $model . "Controller::class);";

        // Determine the path to web.php
        $webPath = base_path('routes/web.php');

        // Check if the route already exists in web.php
        $existingRoute = "'$route'";
        $webContents = File::get($webPath);
        if (Str::contains($webContents, $existingRoute)) {
            $this->error("Resource route for '$route' already exists in web.php.");
            return;
        }

        // Append the route to web.php
        File::append($webPath, PHP_EOL . $routeContent);

        $this->info("Resource route added to web.php for '$route'.");
    }
}

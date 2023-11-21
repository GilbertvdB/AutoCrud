<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class GenerateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:controller {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a controller file for a model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        // $modelName = $this->ask('Enter model name');

        $modelClass = "App\\Models\\$modelName";
        if (! class_exists($modelClass)) {
            $this->error("Model $modelClass not found.");

            return;
        }

        $controllerName = $modelName.'Controller';

        $this->generateControllerFile($controllerName, $modelName);
    }

    protected function generateControllerFile($controllerName, $model)
    {
        $stub = file_get_contents(__DIR__.'/stubs/controller.stub');

        $stub = str_replace('{{modelClass}}', $model, $stub);
        $stub = str_replace('{{model}}', strtolower($model), $stub);

        $controllerPath = app_path('Http/Controllers').'/'.$controllerName.'.php';

        if (File::exists($controllerPath)) {
            $this->error("Controller file already exists: $controllerPath");

            return;
        }

        File::put($controllerPath, $stub);

        $this->info("Controller file created at $controllerPath.");
    }
}

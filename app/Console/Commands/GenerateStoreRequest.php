<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class GenerateStoreRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:storeRequest {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a store request file for a model';

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

        $requestName = 'Store'.$modelName.'Request';

        $this->generateStoreRequestFile($requestName, $modelName);
    }

    protected function generateStoreRequestFile($requestName, $model)
    {
        $stub = file_get_contents(__DIR__.'/stubs/storerequest.stub');

        $fillableProperties = app("App\\Models\\$model")->getFillable();
        $rules = $this->generateValidationRules($fillableProperties);

        $stub = str_replace('{{model}}', $model, $stub);
        $stub = str_replace('{{rules}}', implode("\n            ", $rules), $stub);

        $requestPath = app_path('Http/Requests').'/'.$requestName.'.php';

        if (File::exists($requestPath)) {
            $this->error("Store request file already exists: $requestPath");

            return;
        }

        File::put($requestPath, $stub);

        $this->info("Store request file created at $requestPath.");
    }

    protected function generateValidationRules($fillableProperties)
    {
        $rules = [];
        foreach ($fillableProperties as $property) {
            $rules[] = "'$property' => 'required|max:255',";
        }

        return $rules;
    }
}

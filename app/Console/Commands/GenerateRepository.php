<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;

class GenerateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:repository {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a repository file for a model';

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

        $repositoryName = $modelName . 'Repository';

        $this->generateRepositoryFile($repositoryName, $modelName);
    }

    protected function generateRepositoryFile($repositoryName, $model)
    {
        // Get the stub contents
        $stub = file_get_contents(__DIR__ . '/stubs/repository.stub'); // Replace with actual path to your repository stub

        // Replace the {{ $model }} placeholder with the provided model name
        $stub = str_replace('{{model}}', $model, $stub);

        // Determine the path where the repository file should be created
        $repositoryPath = app_path('Repositories') . '/' . $repositoryName . '.php';

        // Check if the repository file already exists
        if (File::exists($repositoryPath)) {
            $this->error("Repository file already exists: $repositoryPath");
            return;
        }

        // Create the repository file
        File::put($repositoryPath, $stub);

        $this->info("Repository file created at $repositoryPath.");
    }
}

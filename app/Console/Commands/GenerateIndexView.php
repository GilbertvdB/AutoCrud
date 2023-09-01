<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use File;

class GenerateIndexView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an index view for a model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $modelName = $this->argument('model');
        $modelName = $this->ask('Enter model name');

        // Verify if the model exists
        $modelClass = "App\\Models\\$modelName";
        if (!class_exists($modelClass)) {
            $this->error("Model $modelClass not found.");
            return;
        }

        $fillableProperties = app($modelClass)->getFillable();

        // Create a directory with the model's name
        $directoryPath = resource_path('views/' . Str::kebab(Str::plural($modelName)));
        
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true); // Recursive directory creation
        }

        // Read the contents of the stub file
        $stubContent = file_get_contents(__DIR__ . '/stubs/index.stub');

        // Replace placeholders in the stub content
        $viewContent = str_replace(
            ['{{model}}', '{{th}}', '{{td}}'],
            [strtolower($modelName), $this->generateTableHeaders($fillableProperties), $this->generateTableData($fillableProperties, strtolower($modelName))],
            $stubContent
        );

        // Determine the path for the view file
        $viewPath = $directoryPath . '/index.blade.php';

        // Write the view content to the file
        File::put($viewPath, $viewContent);

        $this->info("Index view created at $viewPath.");
    }

    protected function generateTableHeaders($fillableProperties)
    {
        $th = '';
        foreach ($fillableProperties as $property) {
            $label = __('labels.' . $property);
            $th .= "            <th>{{ __('$label') }}</th>\n";
        }
        return $th;
    }

    protected function generateTableData($fillableProperties, $model)
    {
        $td = '';
        foreach ($fillableProperties as $property) {
            $td .= "            <td>{{ \${$model}->{$property} }}</td>\n";
        }
        return $td;
    }
}

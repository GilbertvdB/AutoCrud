<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UpdateLables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updateLables {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the labels file with models fillables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = $this->argument('model');
        // $model = $this->ask('Enter model name');
        $fillableProperties = $this->getFillableProperties($model);

        if (empty($fillableProperties)) {
            $this->error("Model $model does not have fillable properties.");
            return;
        }

        $labelsPath = resource_path('lang\en\labels.php');

        $updatedLabels = $this->updateLabelsArray($labelsPath, $fillableProperties);

        File::put($labelsPath, $updatedLabels);

        $this->info("Updated labels.php with fillables for model: $model");
    }

    protected function getFillableProperties($model)
    {
        $modelClass = "App\\Models\\$model";

        if (!class_exists($modelClass)) {
            return [];
        }

        return (new $modelClass())->getFillable();
    }

    protected function updateLabelsArray($labelsPath, $fillableProperties)
    {
        // Include the labels.php file
        $labelsArray = include $labelsPath;

        // Update the labels array with fillable properties if they don't already exist
        foreach ($fillableProperties as $property) {
            $property = strtolower($property);
            if (!isset($labelsArray[$property])) {
                $labelsArray[$property] = ucwords(str_replace('_', ' ', $property));
            }
        }

        // Convert the updated array back to PHP code
        $updatedLabels = "<?php\n\nreturn " . var_export($labelsArray, true) . ';';

        return $updatedLabels;
    }
}

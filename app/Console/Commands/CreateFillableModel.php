<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateFillableModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:model {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a model with fillable properties';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->argument('model');
        // $modelName = $this->ask('Enter model name');

        $fillableValues = [];
        while (true) {
            $value = $this->ask('Enter fillable value (leave empty to finish)');
            if (empty($value)) {
                break;
            }
            $fillableValues[] = $value;
        }

        $fillableProperties = "['".implode("', '", $fillableValues)."']";

        $this->call('make:model', ['name' => $modelName]);

        $this->appendToFillableProperties($modelName, $fillableValues);

        $this->info("Model $modelName created with fillable properties.");
    }

    // app/Console/Commands/CreateFillableModel.php

    protected function appendToFillableProperties($modelName, array $fillableValues)
    {
        $modelPath = app_path("Models/{$modelName}.php");
        $modelContents = file_get_contents($modelPath);

        // Generate the fillable properties code
        $fillablePropertiesCode = 'protected $fillable = ['.implode(', ', array_map(function ($value) {
            return "'$value'";
        }, $fillableValues)).'];';

        // Insert the fillable properties code inside the class
        $classOpening = 'class '.$modelName.' extends';
        $updatedModelContents = str_replace(
            "use HasFactory;\n}",
            "use HasFactory;\n\n    ".$fillablePropertiesCode."\n}",
            $modelContents
        );

        file_put_contents($modelPath, $updatedModelContents);
    }
}

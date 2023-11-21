<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateMigrationFromFillable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migration {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration file using a models fillables';

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

        $fillableProperties = app($modelClass)->getFillable();

        $migrationName = 'create_'.Str::snake($modelName).'_table';
        $migrationPath = database_path('migrations').'/'.now()->format('Y_m_d_His').'_'.$migrationName.'.php';

        $this->generateMigrationFile($migrationPath, $fillableProperties, $modelName);

        $this->info("Migration file created at $migrationPath.");
    }

    protected function generateMigrationFile($migrationPath, $fillableProperties, $modelName)
    {
        $stub = file_get_contents(__DIR__.'/stubs/migration.stub'); // Replace with actual path to your migration stub

        $tableName = Str::snake(Str::pluralStudly(class_basename($modelName)));

        $columns = [];
        foreach ($fillableProperties as $property) {
            $type = $this->ask("Enter column type for '$property'");
            // $columns[] = "            \$table->{$type}('$property');";
            $columns[] = "\$table->{$type}('$property');";
        }

        // $columnsCode = implode(PHP_EOL, $columns);
        $columnsCode = implode("\n            ", $columns);

        $stub = str_replace('{{columns}}', $columnsCode, $stub);
        $stub = str_replace('{{tableName}}', $tableName, $stub);

        file_put_contents($migrationPath, $stub);
    }
}

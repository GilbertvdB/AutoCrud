<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AddControllerToRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:routeController {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add the controller to the route for a model';

    public function handle()
    {
        $model = $this->argument('model');
        // $model = $this->ask('Enter model name');
        $controllerName = $model . 'Controller';

        // Determine the path to web.php
        $webPath = base_path('routes/web.php');

        // Check if the controller use statement already exists in web.php
        $useStatement = "use App\\Http\\Controllers\\$controllerName;";
        $webContents = File::get($webPath);
        if (Str::contains($webContents, $useStatement)) {
            $this->error("Controller use statement for '$controllerName' already exists in web.php.");
            return;
        }

        // Define the use statement for the controller
        $useContent = "use App\\Http\\Controllers\\$controllerName;";

        // Split the web.php contents into lines
        $lines = explode("\n", $webContents);

        // Insert the use statement on the 3rd line
        array_splice($lines, 3, 0, $useContent);

        // Combine the lines back into a single string
        $updatedContents = implode("\n", $lines);

        // Write the updated contents back to web.php
        File::put($webPath, $updatedContents);

        $this->info("Controller use statement added to web.php for '$controllerName'.");
    }
}

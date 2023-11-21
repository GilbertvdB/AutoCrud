<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateControllerMethods extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:updateController {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates store and update methods of model controller for file input';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = $this->argument('model');
        $controllerName = "{$model}Controller";
        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");

        if (! file_exists($controllerPath)) {
            $this->error("Controller {$controllerName} does not exist.");

            return;
        }

        // Define the code to be added to the store and update methods
        $storeCode = <<<'PHP'
        if ($request->image !== null) {
            $file = $request->file('image');
            $filename = date('Y_m_d_His').'_'. $file->getClientOriginalName();
            $path = $file->storeAs('images', $filename);
            $create['image'] = $filename;
        }
        PHP;

        $updateCode = <<<PHP
if (\$request->image !== null) {
    \$file = \$request->file('image');
    \$filename = date('Y_m_d_His').'_'. \$file->getClientOriginalName();
    \Illuminate\Support\Facades\Storage::delete('images/' . \$pic->image);
    \$path = \$file->storeAs('images', \$filename);
    \$create['image'] = \$filename;
}
PHP;

        // Read the controller file
        $controllerContents = File::get($controllerPath);
        //TODO check chatgpt - update store contents
        // Add the code to the store and update methods
        $updatedContents = preg_replace_callback(
            '/public function store[\s\S]*?\}/',
            function ($matches) use ($storeCode) {
                return rtrim($matches[0], '}')."\n\n".$storeCode."\n}";
            },
            $controllerContents
        );

        // Write the updated contents back to the controller file
        File::put($controllerPath, $updatedContents);

        $this->info("Code added to the store and update methods of $model controller.");
    }

    //     public function handle()
    //     {
    //         $model = $this->argument('model');
    //         $controllerName = "{$model}Controller";
    //         $controllerPath = app_path("Http/Controllers/{$controllerName}.php");

    //         if (!file_exists($controllerPath)) {
    //             $this->error("Controller {$controllerName} does not exist.");
    //             return;
    //         }

    //         $controllerContents = file_get_contents($controllerPath);

    //         // Add code to the store and update methods
    //         $updatedContents = $this->addCodeToMethods($controllerContents);

    //         // Write the updated contents back to the controller file
    //         file_put_contents($controllerPath, $updatedContents);

    //         $this->info("Code added to store and update methods in {$controllerName}.");
    //     }

    // protected function addCodeToMethods($controllerContents)
    // {
    //     // Define the code to add to the store and update methods
    //     $codeToAdd = <<<PHP
    //     if (\$request->image !== null) {
    //         \$file = \$request->file('image');
    //         \$filename = date('Y_m_d_His').'_'. \$file->getClientOriginalName();
    //         \$path = \$file->storeAs('images', \$filename);
    //         \$create['image'] = \$filename;
    //     }

    //     // Search for the store and update methods and add the code
    //     $controllerContents = preg_replace_callback(
    //         '/public function store\([^)]*\) \{[^}]*\}/s',
    //         function ($matches) use ($codeToAdd) {
    //             return $matches[0] . "\n\n" . $codeToAdd;
    //         },
    //         $controllerContents
    //     );

    //     $controllerContents = preg_replace_callback(
    //         '/public function update\([^)]*\) \{[^}]*\}/s',
    //         function ($matches) use ($codeToAdd) {
    //             return $matches[0] . "\n\n" . $codeToAdd;
    //         },
    //         $controllerContents
    //     );

    //     return $controllerContents;

}

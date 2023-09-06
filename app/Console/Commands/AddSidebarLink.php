<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AddSidebarLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sidebarLink {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a sidebar link for a model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $model = $this->argument('model');
        // $model = $this->ask('Enter model name');
        $link = '/' . Str::lower($model).'s';
        $icon = 'fa-solid fa-link fa-lg'; // Default icon
        $name = Str::studly($model); // Default name

        // Load the config file
        $configPath = config_path('project.php');
        $configArray = config('project');
        
        // Ensure the 'sidebar' key exists in the config array
        if (!isset($configArray['sidebar'])) {
            $configArray['sidebar'] = [];
        }
        // // Decode the JSON configuration
        // $configArray = json_decode($config, true);

        // Add the new sidebar link
        $newLink = [
            'icon' => $icon,
            'name' => $name.'s',
            'link' => $link,
        ];

        $configArray['sidebar'][] = $newLink;

        // Update the configuration in Laravel's config cache
        config(['project' => $configArray]);

        // Convert the configuration array to PHP code with the opening PHP tag
        $updatedConfig = "<?php\n\nreturn " . var_export($configArray, true) . ';';
        File::put($configPath, $updatedConfig);

        $this->info("Sidebar link added for model: $model");
    }
}

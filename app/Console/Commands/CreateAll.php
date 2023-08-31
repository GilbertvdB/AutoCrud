<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class CreateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName = $this->ask('Enter model name');
        $this->call('make:model', ['name' => $modelName]);
        $this->call('make:migration', ['name' => 'create_' . Str::snake($modelName) . '_table']);

        $controllerName = $modelName . 'Controller';
        $this->call('make:controller', ['name' => $controllerName]);
        $this->call('make:resource', ['name' => $modelName]);
        
        // $this->call('make:view', ['name' => 'index']);
        // $this->call('make:view', ['name' => 'create']);
        // $this->call('make:view', ['name' => 'edit']);
    }
}

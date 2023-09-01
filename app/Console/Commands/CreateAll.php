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
    protected $signature = 'app:createAll';

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
        $model = $this->ask('Enter model name');
        $this->call('app:model', ['model' => $model]);
        $this->call('app:migration', ['model' => $model]);
        $this->call('app:repository', ['model' => $model]);
        $this->call('app:storeRequest', ['model' => $model]);
        $this->call('app:controller', ['model' => $model]);
        $this->call('app:route', ['model' => $model]);
        
        // $this->call('make:view', ['name' => 'index']);
        // $this->call('make:view', ['name' => 'create']);
        // $this->call('make:view', ['name' => 'edit']);
    }
}

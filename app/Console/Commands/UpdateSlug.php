<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UpdateSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:slugs {model: The model name} {attribute: The attribute to generate slug from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update slugs for all records of the specified model';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelName=$this->argument('model');
        $attribute=$this->argument('attribute');

        $modelClass='App\\Models\\'.$modelName;

        if(!class_exists($modelClass)){
            $this->error('Model class does not exist.');
            return;
        }

        if (!Schema::hasColumn((new $modelClass)->getTable(),$attribute)){
            $this->error('Attribute does not exist in the model\'s table.');
            return;
        }

        $modelInstances = $modelClass::all();

        foreach ($modelInstances as $instance) {
            $instance->slug = Str::slug($instance->{$attribute});
            $instance->save();
        }

        $this->info('Slugs updated for all records of ' . $modelName . '.');

    }
}

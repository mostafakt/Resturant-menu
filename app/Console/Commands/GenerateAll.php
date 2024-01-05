<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:all {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $modelName = $this->argument('name');

        $this->createModel($modelName);
        $this->createController($modelName);
        $this->createRequest($modelName);
        $this->createResource($modelName);
        $this->createService($modelName);
        $this->createFilter($modelName);

        $this->info('All files generated successfully.');

        return Command::SUCCESS;
    }

    protected function createModel(string $modelName)
    {
        Artisan::call('make:model', [
            'name' => $modelName,
            '-f' => true,
            '-s' => true,
            '-m' => true,
            '--policy' => true,
        ]);

        $this->info('Model,factory,seeder,migration,policy generated successfully.');
    }

    /**
     * Create a new controller.
     *
     * @param string $modelName
     * @return void
     */
    protected function createController(string $modelName)
    {
        Artisan::call('make:controller', [
            'name' => $modelName . 'Controller',
            '--api' => true,
            '--model' => $modelName,
        ]);
        $this->info('controller generated successfully.');
    }

    /**
     * Create a new (Store-Update) request.
     *
     * @param string $modelName
     * @return void
     */
    protected function createRequest(string $modelName)
    {
        Artisan::call('make:request', [
            'name' => $modelName . '/' . $modelName . 'Request',
        ]);


        $this->info('formRequest generated successfully.');
    }

    /**
     * Create a new (Minimal-Summary-Full) resource.
     *
     * @param string $modelName
     * @return void
     */
    protected function createResource(string $modelName)
    {
        Artisan::call('make:resource', [
            'name' => $modelName . '/' . $modelName . 'Light',
        ]);

        Artisan::call('make:resource', [
            'name' => $modelName . '/' . $modelName . 'List',
        ]);

        Artisan::call('make:resource', [
            'name' => $modelName . '/' . $modelName . 'Details',
        ]);

        $this->info('Light-List-Details Resource generated successfully.');
    }

    /**
     * Create a new service.
     *
     * @param string $modelName
     * @return void
     */
    protected function createService(string $modelName)
    {
        Artisan::call('make:service', [
            'name' => $modelName,
        ]);
        $this->info('service generated successfully.');
    }

    /**
     * Create a new filter.
     *
     * @param string $modelName
     * @return void
     */
    protected function createFilter(string $modelName)
    {
        Artisan::call('make:filter', [
            'name' => $modelName,
        ]);
        $this->info('filter generated successfully.');
    }
}

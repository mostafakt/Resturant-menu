<?php

namespace App\Console\Commands;

use App\Services\RabbitMQService;
use Illuminate\Console\Command;

class MQConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mq:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume the mq queue';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        $service = new RabbitMQService();
        $service->driversStatus();
        $service->listenQueue('search-stores', [$service, 'searchStoresCallback']);
        $service->listenQueue('search-drivers', [$service, 'searchDriversCallback']);
        $service->listenQueue('driver-broadcast', [$service, 'driverBroadcastCallback']);
        $service->registerMethods();
        $service->startConsuming();
    }
}

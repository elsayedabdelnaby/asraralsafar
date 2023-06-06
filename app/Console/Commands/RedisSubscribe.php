<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Modules\Operations\Actions\OrdersMonitorIng\GetOrderDetailsAction;
use Predis\Client;

class RedisSubscribe extends Command
{
    protected $signature   = 'redis:subscribe';
    protected $description = 'Subscribe to a Redis channel';
    private   $redis;
    private   $publisher;
    private   $subscribe   = [
        'order-monitoring'
    ];
    private   $redisPrefix;

    public function __construct()
    {
        parent::__construct();
        $this->redisPrefix = env('REDIS_PREFIX', 'wattage_database_');
        $this->redis       = Redis::connection('subscriber');
        $this->publisher   = new Client([
            "port" => env("REDIS_PORT")
        ]);
    }

    public function handle()
    {
        //I can Listen On This Channels
        $publisher = $this->publisher;
        $this->redis->subscribe($this->subscribe, function ($message) use ($publisher) {
            //do Something
        });
    }

    public function publisherOrderChangeStatus(int $order_id): void
    {
        $request = new Request();
        $request->request->add(['id' => $order_id]);
        $order = (new GetOrderDetailsAction())->handle($request);
        $this->publisher->publish($this->redisPrefix . 'order-monitoring-publish', json_encode(collect($order)->toArray()));
    }

    public function publisherToPublicChannel(array $attrs): void
    {
        $this->publisher->publish($this->redisPrefix . 'public', json_encode($attrs));
    }
}


<?php

namespace Database\Seeders;

use App\Models\Client\Client;
use App\Models\Order\Order;
use App\Models\Transaction\OrderTransaction;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    protected $faker;

    public function __construct() {
        $this->faker = $this->withFaker();
    }
    protected function withFaker()
    {
        return Container::getInstance()->make(Generator::class);
    }

    public function run()
    {
        for($i=0;$i<10;$i++) {
            $client = Client::create([
                'firstname' =>$this->faker->name(),
                'surname' => $this->faker->name(),
            ]);
            for($j=0;$j<2;$j++) {
                $order = Order::create([
                    'client_id' => $client->id,
                    'date' => Carbon::today()->format('Y-d-m'),
                    'status_id' => 1,
                ]);
                for($k=0;$k<2;$k++) {
                    OrderTransaction::create([
                        'order_id' => $order->id,
                        'total' =>10,
                    ]);
                }
            }
        }
    }
}

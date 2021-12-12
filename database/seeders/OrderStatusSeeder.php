<?php

namespace Database\Seeders;

use App\Models\Order\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = OrderStatus::Statuses;
        foreach($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}

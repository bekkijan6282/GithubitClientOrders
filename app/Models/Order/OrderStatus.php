<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    const Statuses = [
        ['status_name' => 'new','display_name' => 'Yangi'],
        ['status_name' => 'onprogress','display_name' => 'Jarayonda'],
        ['status_name' => 'done','display_name' => 'Bajarildi'],
    ];
}

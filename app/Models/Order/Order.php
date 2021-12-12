<?php

namespace App\Models\Order;

use App\Models\Client\Client;
use App\Models\Transaction\OrderTransaction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'status_id',
        'date',
    ];

    public function cur_status(): BelongsTo
    {
        return $this->belongsTo(OrderStatus::class,'status_id','id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(OrderTransaction::class, 'order_id','id');
    }
}

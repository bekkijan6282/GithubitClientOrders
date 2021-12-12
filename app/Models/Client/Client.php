<?php

namespace App\Models\Client;

use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'surname',
    ];

public function scopeFilter(Builder $builder, Request $request): Builder
{
    return $builder->when($request->search, function(Builder $builder, string $search) {
        $builder
            ->where('first_name','ilike',$search)
            ->orWhere('last_name','ilike',$search);
    })->when($request->date, function(Builder $builder, string $date) {
        $builder->whereHas('orders', function(Builder $builder) use ($date) {
            $builder->whereDate('date',$date);
        });
    });
}

public function orders(): HasMany
{
    return $this->hasMany(Order::class,'client_id','id');
}

}

<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'surname',
        'contacts',
    ];

public function scopeFilter(Builder $builder, Request $request): Builder
{
    return $builder->when($request->search, function(Builder $builder, $search) {
        $builder
            ->where('first_name','ilike',$search)
            ->orWhere('last_name','ilike',$search)
            ->orWhere('contacts','ilike',$search);
    });
}

}

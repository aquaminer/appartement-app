<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $table = "apartments";
    public $timestamps = false;

    public $fillable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages'
    ];

    public function scopePrice(Builder $query, int $min, int $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    public function scopeName(Builder $query, string $name)
    {
        return $query->where('name', 'like', "%{$name}%");
    }

    public function scopeBedrooms(Builder $query, int $bedrooms)
    {
        return $query->where('bedrooms', $bedrooms);
    }

    public function scopeBathrooms(Builder $query, int $bathrooms)
    {
        return $query->where('bathrooms', $bathrooms);
    }

    public function scopeStoreys(Builder $query, int $storeys)
    {
        return $query->where('storeys', $storeys);
    }

    public function scopeGarages(Builder $query, int $garages)
    {
        return $query->where('garages', $garages);
    }
}

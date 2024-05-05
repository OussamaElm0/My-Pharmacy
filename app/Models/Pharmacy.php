<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pharmacy extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'inpe',
        'city',
        'address',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, "pharmacy_product")->withPivot('quantity');
    }
    public function users() {
        return $this->hasMany(User::class);
    }
    public function ventes()
    {
        return $this->hasMany(Vente::class);
    }
}

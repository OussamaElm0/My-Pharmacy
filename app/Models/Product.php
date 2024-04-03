<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type_id',
        'category_id',
        'price',
        'quantity',
        'importation_date',
        'expiration_date',
    ] ;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, "pharmacy_product")->withPivot('quantity');
    }
}

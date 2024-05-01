<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    use HasFactory;

    protected $table = "ventes";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}

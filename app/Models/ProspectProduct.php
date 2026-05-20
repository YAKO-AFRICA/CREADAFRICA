<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProspectProduct extends Model
{
    use HasFactory;

    protected $connection = 'mysql3';
    protected $table = 'prospect_products';

    protected $fillable = [
        'prospect_id',
        'product_id',
        'product_formule',
        'product_code',
    ];

    public function itemProduct()
    {
        return $this->belongsTo(Product::class, 'product_code','CodeProduit');
    }
}

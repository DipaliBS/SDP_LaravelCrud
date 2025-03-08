<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPurchaseHistory extends Model
{
    use HasFactory;

    protected $table = 'product_purchase_history';

    public function product()
    {
        return $this->belongsTo(Product::class, 'productid');
    }
}

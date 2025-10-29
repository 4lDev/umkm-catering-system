<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_name', 'customer_wa', 'customer_address', 'total_price', 'status'];

    /**
     * Mendefinisikan relasi "satu-ke-banyak".
     * Satu Order memiliki banyak OrderItem.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
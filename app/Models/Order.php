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

    public function toWhatsAppMessage()
    {
        return "Halo, saya *{$this->customer_name}* telah melakukan pesanan dengan nomor order *#{$this->id}*.\n\n" .
            "Total pembayaran: Rp " . number_format($this->total_price, 0, ',', '.') . "\n" .
            "Alamat pengiriman:\n{$this->customer_address}\n\n" .
            "Mohon konfirmasi pesanan saya, terima kasih 🙏";
    }

}
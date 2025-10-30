<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_name', 'customer_wa', 'customer_address', 'total_price', 'status', 'delivery_method'];

    /**
     * Mendefinisikan relasi "satu-ke-banyak".
     * Satu Order memiliki banyak OrderItem.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Menghasilkan teks pesan WhatsApp yang terformat untuk Admin.
     * Pesan ini dikirim oleh PELANGGAN.
     *
     * @return string
     */
    public function toWhatsAppMessage(): string
    {
        // 1. Pastikan relasi orderItems sudah dimuat (mencegah error N+1)
        $this->loadMissing('orderItems');

        // 2. Siapkan variabel untuk item
        $itemsList = "";
        foreach ($this->orderItems as $item) {
            $subtotal = number_format($item->price * $item->quantity, 0, ',', '.');
            $itemsList .= "- {$item->product_name} (x{$item->quantity}) = Rp {$subtotal}\n";
        }

        // 3. Siapkan variabel untuk metode pengiriman
        $deliveryText = ($this->delivery_method == 'delivery') ? "Diantar (Delivery)" : "Ambil Sendiri (Pickup)";

        // 4. Rangkai Pesan Lengkap
        $message = "Halo, saya *{$this->customer_name}*.\n";
        $message .= "Saya telah melakukan pesanan di website Anda.\n\n";
        
        $message .= "*RINCIAN PESANAN:*\n";
        $message .= "Nomor Order: *#{$this->id}*\n";
        $message .= "Tanggal: {$this->created_at->format('d M Y, H:i')}\n";
        $message .= "---------------------------\n";
        $message .= $itemsList; // <-- Item yang dipesan
        $message .= "---------------------------\n";
        $message .= "*Total Pembayaran:* Rp " . number_format($this->total_price, 0, ',', '.') . "\n\n";

        $message .= "*INFO PENGIRIMAN:*\n";
        $message .= "Metode: *{$deliveryText}*\n";
        $message .= "Alamat:\n{$this->customer_address}\n\n";
        
        $message .= "*KONTAK SAYA:*\n";
        $message .= "WA: {$this->customer_wa}\n\n";

        $message .= "Mohon segera dikonfirmasi, terima kasih";

        return $message;
    }

}
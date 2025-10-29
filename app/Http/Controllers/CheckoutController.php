<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Penting untuk Transaksi

class CheckoutController extends Controller
{
    /**
     * Menampilkan halaman checkout.
     */
    public function index()
    {
        // Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // PENTING: Jika keranjang kosong, jangan tampilkan checkout,
        // alihkan kembali ke homepage dengan pesan error.
        if (count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Keranjang Anda kosong, silakan belanja dulu.');
        }

        // Jika keranjang ada isi, tampilkan halaman checkout
        return view('checkout.index');
    }


    /**
     * Menyimpan pesanan ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari formulir
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_wa' => 'required|string|max:20',
            'customer_address' => 'required|string',
        ]);

        // 2. Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // 3. Cek lagi jika keranjang kosong (untuk keamanan)
        if (count($cart) == 0) {
            return redirect()->route('home')->with('error', 'Gagal membuat pesanan, keranjang Anda kosong.');
        }

        // 4. Hitung ulang total harga (sisi server, lebih aman)
        $total = 0;
        foreach ($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // 5. Mulai Transaksi Database
        // Ini memastikan jika salah satu query gagal, semua akan dibatalkan
        try {
            DB::beginTransaction();

            // 6. Simpan data pesanan utama ke tabel 'orders'
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'customer_wa' => $validated['customer_wa'],
                'customer_address' => $validated['customer_address'],
                'total_price' => $total,
                'status' => 'pending', // Status awal pesanan baru
            ]);

            // 7. Simpan setiap item di keranjang ke tabel 'order_items'
            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id, // Hubungkan ke ID pesanan utama
                    'product_id' => $id,       // ID produk
                    'product_name' => $details['name'],
                    'price' => $details['price'],
                    'quantity' => $details['quantity'],
                ]);
            }

            // 8. Jika semua berhasil, 'commit' transaksi
            DB::commit();

            // 9. Hapus keranjang dari session (karena sudah selesai)
            session()->forget('cart');

            // 10. Alihkan ke halaman sukses (Nanti kita buat halaman 'Terima Kasih')
            // Untuk sekarang, kita alihkan ke homepage dengan pesan sukses
            return redirect()->route('checkout.success')->with('order_id', $order->id);
            
        } catch (\Exception $e) {
            // 11. Jika terjadi error, 'rollback' (batalkan) semua
            DB::rollBack();
            
            // Alihkan kembali ke halaman checkout dengan pesan error
            return redirect()->back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
            // (Untuk debug, Anda bisa tambahkan: . $e->getMessage())
        }
    }

    public function success()
    {
        // Pastikan pelanggan datang dari checkout, bukan akses langsung
        if (!session('order_id')) {
            return redirect()->route('home');
        }

        return view('checkout.success');
    }
}
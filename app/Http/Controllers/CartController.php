<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    public function index()
    {
        // Ambil data keranjang dari session
        $cart = session()->get('cart', []);

        // Kirim data ke view
        return view('cart.index', compact('cart'));
    }

    /**
     * Menambahkan produk ke keranjang.
     */
    public function store(Product $product)
    {
        // 1. Ambil keranjang dari session, atau buat array kosong jika belum ada
        $cart = session()->get('cart', []);

        // 2. Cek apakah produk sudah ada di keranjang
        if(isset($cart[$product->id])) {
            // Jika sudah ada, tambahkan quantity-nya
            $cart[$product->id]['quantity']++;
        } else {
            // Jika belum ada, tambahkan sebagai item baru
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                // "image" => $product->image_path // Nanti bisa ditambahkan
            ];
        }

        // 3. Simpan kembali keranjang ke session
        session()->put('cart', $cart);

        // 4. Alihkan kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    /**
     * Menghapus item dari keranjang.
     */
    public function destroy($productId)
    {
        // 1. Ambil keranjang dari session
        $cart = session()->get('cart', []);

        // 2. Cek apakah item ada di keranjang, lalu hapus
        if(isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        // 3. Alihkan kembali ke halaman keranjang dengan pesan sukses
        return redirect()->route('cart.index')->with('success', 'Menu berhasil dihapus dari keranjang.');
    }
}
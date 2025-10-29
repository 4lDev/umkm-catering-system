<?php

namespace App\Http\Controllers\Admin; // <-- Namespace harus ini

use App\Http\Controllers\Controller;
use App\Models\Order; // <-- Penting
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Menampilkan detail satu pesanan.
     */
    public function show(Order $order)
    {
        $order->load('orderItems');
        return view('admin.orders.show', compact('order')); // <-- INI YANG BENAR
    }

    /**
     * Update status pesanan.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // 1. Validasi input
        $validated = $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
        ]);

        // 2. Update status di database
        $order->update([
            'status' => $validated['status'],
        ]);

        // 3. Alihkan kembali ke halaman detail dengan pesan sukses
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
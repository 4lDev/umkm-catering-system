<?php

namespace App\Http\Controllers;

use App\Models\Product; // <-- TAMBAHKAN INI
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // TAMBAHKAN FUNGSI INI
    public function index()
    {
        // Ambil semua produk yang statusnya 'Tersedia'
        $products = Product::where('is_available', true)->latest()->get();

        // Kirim data products ke view 'home.blade.php'
        return view('home', compact('products'));
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // !!! TAMBAHKAN BARIS-BARIS DI BAWAH INI !!!
    protected $fillable = [
        'name',
        'price',
        'description',
        'is_available',
        // 'image_path' // Kita akan tambahkan ini nanti
    ];
}
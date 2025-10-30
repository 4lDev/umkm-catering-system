<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
                // Menyimpan metode (misal: 'cod' atau 'transfer')
                $table->string('payment_method')->after('delivery_method');
                // Menyimpan status bayar (misal: 'unpaid' atau 'paid')
                $table->string('payment_status')->after('payment_method')->default('unpaid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};

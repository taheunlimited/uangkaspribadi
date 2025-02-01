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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['Pemasukan', 'Pengeluaran']);//jenis transaksi
            $table->decimal('amount', 15, 2);//jumlah uang
            $table->enum('wallets', ['UangTunai','UangDigital','ATM']);
            $table->text('description')->nullable();//keterangan transaksi
            $table->date('date');//tanggal transaksi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};

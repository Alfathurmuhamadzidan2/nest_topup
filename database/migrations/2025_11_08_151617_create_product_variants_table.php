<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            $table->string('name');              // nama varian
            $table->integer('amount')->nullable(); // contoh 5 diamonds
            $table->bigInteger('price');        // harga
            $table->bigInteger('promo_price')->nullable(); // opsional harga promo

            $table->text('description')->nullable(); // deskripsi varian

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};

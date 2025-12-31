<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique()->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variant_id')->nullable()->constrained('product_variants')->onDelete('set null');
            $table->integer('amount')->nullable(); // e.g. amount diamonds or quantity
            $table->bigInteger('total_price'); // final amount paid
            $table->string('payment_method')->nullable(); // saldo, qris, dana, gopay, transfer
            $table->string('account_id')->nullable(); // id game
            $table->string('contact')->nullable(); // user contact
            $table->enum('status', ['pending','success','failed'])->default('pending');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};

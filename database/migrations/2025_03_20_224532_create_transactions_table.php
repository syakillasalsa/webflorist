<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->enum('payment_method', ['QRIS', 'Bank Transfer']);
            $table->string('payment_proof')->nullable(); // Hanya untuk Bank Transfer
            $table->enum('status', ['Pending', 'Waiting Verification', 'Paid', 'Shipped'])->default('Pending');
            $table->timestamps();
            
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->integer('shipping_cost')->default(0);
        });
        
    }

    public function down() {
        Schema::dropIfExists('transactions');
    }
};

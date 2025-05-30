<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->date('pickup_date')->nullable();
        $table->time('pickup_time')->nullable();
        $table->date('delivery_date')->nullable();
        $table->time('delivery_time')->nullable();
    });
}

public function down()
{
    Schema::table('transactions', function (Blueprint $table) {
        $table->dropColumn(['pickup_date', 'pickup_time', 'delivery_date', 'delivery_time']);
    });
}
};
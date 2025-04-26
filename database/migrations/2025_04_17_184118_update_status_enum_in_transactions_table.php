<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('Pending', 'Waiting Verification', 'Paid', 'Shipped', 'Success') DEFAULT 'Pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE transactions MODIFY COLUMN status ENUM('Pending', 'Waiting Verification', 'Paid', 'Shipped') DEFAULT 'Pending'");
    }
};

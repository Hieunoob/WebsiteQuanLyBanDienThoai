<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Chỉ thêm cột total nếu chưa có
            if (!Schema::hasColumn('orders', 'total')) {
                $table->decimal('total', 15, 2)->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'total')) {
                $table->dropColumn('total');
            }
        });
    }
};
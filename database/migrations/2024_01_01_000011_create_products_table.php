<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('brand');
            $table->string('slug')->unique();
            $table->decimal('price', 15, 0); // Giá VNĐ không có số thập phân
            $table->integer('quantity')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            // Thông số kỹ thuật
            $table->string('screen')->nullable();
            $table->string('ram')->nullable();
            $table->string('storage')->nullable();
            $table->string('camera')->nullable();
            $table->string('battery')->nullable();
            $table->string('operating_system')->nullable();
            $table->boolean('is_featured')->default(false); // Sản phẩm nổi bật
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

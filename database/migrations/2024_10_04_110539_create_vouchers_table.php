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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã voucher
            $table->string('description_voucher')->nullable(); // Mô tả
            $table->integer('value')->nullable(); // Giá trị giảm giá
            $table->integer('usage_limit')->default(1); // Số lần sử dụng tối đa
            $table->enum('type', ['percent', 'fixed'])->default('percent'); // Loại giảm giá
            $table->timestamp('start_date')->nullable(); // Thời gian bắt đầu
            $table->timestamp('end_date')->nullable(); // Thời gian kết thúc
            $table->decimal('minimum_order_value', 8, 2)->nullable(); // Giá trị tối thiểu của đơn hàng
            $table->string('applicable_products')->nullable(); // Danh sách ID sản phẩm áp dụng (dạng chuỗi JSON)
            $table->string('applicable_categories')->nullable(); // Danh sách ID danh mục áp dụng (dạng chuỗi JSON)
            $table->unsignedBigInteger('user_id')->nullable(); // Chỉ áp dụng cho người dùng cụ thể
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};

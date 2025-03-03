<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropVouchersTableMigration extends Migration
{
    public function up()
    {
        Schema::dropIfExists('vouchers'); // Xóa bảng 'vouchers'
    }

    public function down()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('value', 8, 2);
            $table->enum('type', ['percent', 'fixed']);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->timestamps();
        });
    }
}
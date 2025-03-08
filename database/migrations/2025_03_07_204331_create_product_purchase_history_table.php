<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_purchase_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productid')->constrained('product')->onDelete('cascade');
            $table->foreignId('userid')->constrained('user')->onDelete('cascade');
            $table->enum('purchase_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_purchase_history');
    }
};

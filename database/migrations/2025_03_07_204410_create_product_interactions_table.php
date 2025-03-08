<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('product_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productid')->constrained('product')->onDelete('cascade');
            $table->foreignId('userid')->constrained('user')->onDelete('cascade');
            $table->enum('interaction_type', ['view', 'add_to_cart', 'wishlist']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_interactions');
    }
};

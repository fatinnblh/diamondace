<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('file_path');
            $table->string('paper_size');
            $table->string('binding_style');
            $table->string('cover_colour');
            $table->integer('quantity');
            $table->integer('page_count');
            $table->decimal('base_cost', 8, 2);
            $table->string('shipping_option')->nullable(); // Add this line
            $table->string('payment_method')->nullable(); // Add this line
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
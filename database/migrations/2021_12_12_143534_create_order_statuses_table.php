<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesTable extends Migration
{
    public function up(): void
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status_name');
            $table->string('display_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
}

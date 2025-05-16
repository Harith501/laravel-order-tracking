<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->string('customer_name');
            $table->date('installation_date');
            $table->string('exchange');
            $table->string('work_activity');
            $table->string('id_slot_order');
            $table->string('team_leader');
            $table->string('team_member_1');
            $table->string('team_member_2')->nullable();
            $table->string('team_member_3')->nullable();
            $table->string('order_status')->default('PENDING');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}

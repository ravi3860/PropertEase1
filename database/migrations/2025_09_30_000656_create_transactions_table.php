<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases')->onDelete('cascade');
            $table->string('provider')->nullable();           // e.g., manual (no gateway)
            $table->string('provider_charge_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('currency', 10)->default('LKR');
            $table->string('status')->default('pending');    // pending, paid, failed, refunded
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->index(['status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

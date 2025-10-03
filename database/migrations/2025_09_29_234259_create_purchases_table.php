<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained('properties')->onDelete('cascade');
            $table->foreignId('buyer_id')->constrained('members')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('members')->onDelete('cascade');
            $table->decimal('price_at_purchase', 15, 2);
            $table->decimal('deposit_percent', 5, 2)->nullable();
            $table->decimal('deposit_amount', 15, 2);
            $table->decimal('platform_fee', 15, 2)->default(0);
            $table->string('status')->default('initiated'); // initiated, pending_payment, deposit_paid, reserved, awaiting_settlement, completed, cancelled, failed
            $table->timestamp('reserved_until')->nullable();
            $table->boolean('contact_requested')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status']);
            $table->index(['buyer_id']);
            $table->index(['seller_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}

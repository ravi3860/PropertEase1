<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade'); // owner
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 15, 2)->default(0); // enough precision
            $table->string('property_type')->nullable(); // House/Apartment/Land/Commercial
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable()->default('Sri Lanka');
            $table->unsignedInteger('bedrooms')->nullable();
            $table->unsignedInteger('bathrooms')->nullable();
            $table->decimal('area', 10, 2)->nullable(); // square feet/meters
            $table->unsignedSmallInteger('year_built')->nullable();
            $table->enum('status', ['available', 'sold'])->default('available');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // indices
            $table->index(['city']);
            $table->index(['status']);
            $table->index(['price']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
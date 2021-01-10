<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_types', function(Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('lat_long');
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->boolean('is_verif')->default(0);
            $table->enum('status', ['DRAFT', 'PUBLISH'])->default('PUBLISH');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('location_type_id')->nullable()->constrained('location_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
        Schema::dropIfExists('location_types');
    }
}

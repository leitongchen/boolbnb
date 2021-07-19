<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->text('title');
            $table->string('address_street', 255);
            $table->string('street_number', 10);
            $table->string('city', 100);
            $table->string('zip_code', 10);
            $table->string('province', 100);
            $table->string('nation', 100);

            $table->decimal('latitude', 8, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();

            $table->integer('rooms_number');
            $table->integer('beds_number');
            $table->integer('bathrooms_number');
            $table->decimal('floor_area', 8, 2);

            $table->string('img_url', 255);
            $table->boolean('visible');

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
        Schema::dropIfExists('apartments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentExtraServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_extra_service', function (Blueprint $table) {


            $table->foreignId('apartment_id')
                ->constrained();
            
            $table->foreignId('extra_services_id')
            ->constrained();

            $table->primary(["apartment_id", "extra_services_id"]);
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
        Schema::dropIfExists('apartment_extra_service');
    }
}

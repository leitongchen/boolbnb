<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentSponsorshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_sponsorship', function (Blueprint $table) {

            $table->date('start_at');

            $table->foreignId('apartment_id')
            ->constrained();
        
            $table->foreignId('sponsorship_id')
            ->constrained();

            $table->primary(["apartment_id", "sponsorship_id"]);

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
        Schema::dropIfExists('apartment_sponsorship');
    }
}

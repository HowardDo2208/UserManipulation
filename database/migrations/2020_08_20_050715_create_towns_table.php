<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_GeoTown', function (Blueprint $table) {
            $table-> unsignedInteger('geoTownId')->autoIncrement();
            $table-> unsignedInteger('geoTownShipId') ->nullable();
            $table-> string('geoTownCode')->nullable();
            $table-> string('geoTownName')->nullable();
            $table-> string('geoTownNameBurmese')->nullable();
            $table-> string('geoTownLongitude')->nullable();
            $table-> string('geoTownLatitude')->nullable();
            $table-> text('geoTownRemark')->nullable();
            $table-> unsignedSmallInteger('isVillage')->nullable()->comment('Village Tract');
            $table->timestamp('dtCreated')->useCurrent()->nullable();
            $table->unsignedInteger('personCreated')->nullable();
            $table->timestamp('dtUpdated')->useCurrent()->nullable();
            $table->unsignedInteger('personUpdated')->nullable();
            $table->timestamp('dtDeleted')->nullable();
            $table->unsignedInteger('personDeleted')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_GeoTown');
    }
}

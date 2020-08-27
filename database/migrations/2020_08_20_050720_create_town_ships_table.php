<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTownShipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_GeoTownShip', function (Blueprint $table) {
            $table->unsignedInteger('geoTownShipId')->autoIncrement();
            $table->unsignedInteger('geoDistrictId')->nullable();
            $table->string('geoTownShipCode')->nullable();
            $table->string('geoTownShipName')->nullable();
            $table->string('geoTownShipNameBurmese')->nullable();
            $table->text('geoTownShipRemark')->nullable();
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
        Schema::dropIfExists('tbl_GeoTownShip');
    }
}

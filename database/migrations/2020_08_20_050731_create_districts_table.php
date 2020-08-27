<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_GeoDistrict', function (Blueprint $table) {
            $table->unsignedInteger('geoDistrictId')->autoIncrement();
            $table->unsignedInteger('geoRegionId')->nullable();
            $table->string('geoDistrictCode')->nullable();
            $table->string('geoDistrictName')->nullable();
            $table->string('geoDistrictNameBurmese')->nullable();
            $table->text('geoDistrictRemark')->nullable();
            $table->unsignedInteger('personCreated')->nullable();
            $table->timestamp('dtCreated')->useCurrent()->nullable();
            $table->unsignedInteger('personUpdated')->nullable();
            $table->timestamp('dtUpdated')->useCurrent()->nullable();
            $table->unsignedInteger('personDeleted')->nullable();
            $table->timestamp('dtDeleted')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_GeoDistrict');
    }
}

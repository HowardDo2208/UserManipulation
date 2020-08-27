<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_GeoRegion', function (Blueprint $table) {
            $table->unsignedInteger('geoRegionId')->autoIncrement();
            $table->string('geoRegionCode')->nullable();
            $table->string('geoRegionName')->nullable();
            $table->string('geoRegionNameBurmese')->nullable();
            $table->text('geoRegionRemark')->nullable();
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
        Schema::dropIfExists('tbl_GeoRegion');
    }
}

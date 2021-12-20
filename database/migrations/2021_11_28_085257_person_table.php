<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PersonTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->string('city_id');
            $table->string('district_id');
            $table->string('ward_id');
            $table->string('village_id');
            $table->string('person_id');
            $table->string('person_name');
            $table->date('person_date');
            $table->string('person_gender');
            $table->string('person_permanent_address');
            $table->string('person_temporary_address');
            $table->string('person_religion');
            $table->string('person_level');
            $table->string('person_job');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CollectionTrack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('collection_track', function (Blueprint $table) {
            $table->bigInteger('collection_id')->unsigned();
            $table->foreign('collection_id')->references('id')->on('collections');
            $table->bigInteger('track_id')->unsigned();
            $table->foreign('track_id')->references('id')->on('tracks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('collection_track');

    }
}

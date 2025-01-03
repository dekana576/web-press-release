<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToPressReleasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('press_release', function (Blueprint $table) {
            $table->json('image')->nullable()->after('description'); // Use JSON to store multiple images
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('press_release', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}

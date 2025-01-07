<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('press_release', function (Blueprint $table) {
            $table->date('date')->nullable()->after('created_at');
            $table->string('link_baliprawara')->nullable()->after('link_baliekbis');
            $table->string('link_baliwara')->nullable()->after('link_baliprawara');
            $table->string('link_balipost')->nullable()->after('link_baliwara');
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
            $table->dropColumn('date');
            $table->dropColumn('link_baliprawara');
            $table->dropColumn('link_baliwara');
            $table->dropColumn('link_balipost');
        });
    }
}
;
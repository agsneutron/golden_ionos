<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPickups141219Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->date('real_pickup_date')->nullable()->default(null)->after('time_pickup');
            $table->date('real_pickup_time')->nullable()->default(null)->after('real_pickup_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->dropColumn('real_pickup_date');
            $table->dropColumn('real_pickup_time');
        });
    }
}

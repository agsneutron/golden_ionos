<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPickups121219Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->time('time_pickup')->nullable()->default(null)->after('day_pickup');
            $table->string('harvest_comments', 1000)->default('')->after('comments');
            $table->string('harvest_contact_name')->default('')->after('harvest_comments');
            $table->mediumText('harvest_contact_signature')->default('')->after('harvest_contact_name');
            $table->mediumText('harvest_photo')->default('')->after('harvest_contact_signature');
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
            $table->dropColumn('time_pickup');
            $table->dropColumn('harvest_comments');
            $table->dropColumn('harvest_contact_name');
            $table->dropColumn('harvest_contact_signature');
            $table->dropColumn('harvest_photo');
        });
    }
}

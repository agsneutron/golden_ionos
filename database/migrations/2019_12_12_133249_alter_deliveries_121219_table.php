<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDeliveries121219Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->date('real_delivery_date')->nullable()->default(null)->after('day_delivery');
            $table->time('real_delivery_time')->nullable()->default(null)->after('real_delivery_date');

            $table->string('delivery_comments', 1000)->default('')->after('comments');
            $table->string('delivery_contact_name')->default('')->after('delivery_comments');
            $table->mediumText('delivery_contact_signature')->default('')->after('delivery_contact_name');
            $table->mediumText('delivery_photo')->default('')->after('delivery_contact_signature');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn('real_delivery_date');
            $table->dropColumn('real_delivery_time');
            $table->dropColumn('delivery_comments');
            $table->dropColumn('delivery_contact_name');
            $table->dropColumn('delivery_contact_signature');
            $table->dropColumn('delivery_photo');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrders121219Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('harvest_date')->nullable()->default(null)->after('folio');
            $table->string('harvest_time')->nullable()->default(null)->after('harvest_date');

            $table->string('harvest_comments', 1000)->default('')->after('id_client_user');
            $table->string('harvest_contact_name')->default('')->after('harvest_comments');
            $table->mediumText('harvest_contact_signature')->default('')->after('harvest_contact_name');
            $table->mediumText('harvest_photo')->default('')->after('harvest_contact_signature');

            $table->string('delivery_comments', 1000)->default('')->after('harvest_photo');
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('harvest_date');
            $table->dropColumn('harvest_time');
            $table->dropColumn('harvest_comments');
            $table->dropColumn('harvest_contact_name');
            $table->dropColumn('harvest_contact_signature');
            $table->dropColumn('harvest_photo');
            $table->dropColumn('delivery_comments');
            $table->dropColumn('delivery_contact_name');
            $table->dropColumn('delivery_contact_signature');
            $table->dropColumn('delivery_photo');
        });
    }
}

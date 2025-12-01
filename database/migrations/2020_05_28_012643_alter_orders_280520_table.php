<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrders280520Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('rank')->default(0)->after('delivery_photo');
            $table->unsignedInteger('qualified')->default(0)->after('rank');
            $table->string('client_comments', 1000)->default('')->after('qualified');
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
            $table->dropColumn('rank');
            $table->dropColumn('qualified');
            $table->dropColumn('client_comments');
        });
    }
}

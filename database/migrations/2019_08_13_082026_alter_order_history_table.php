<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_history', function (Blueprint $table) {
            $table->unsignedInteger('deleted_payment')->after('id_payment_method')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_history', function (Blueprint $table) {
            $table->dropColumn('deleted_payment');
        });
    }
}

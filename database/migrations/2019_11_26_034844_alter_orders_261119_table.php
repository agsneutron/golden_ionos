<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrders261119Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('id_delivery_user')->nullable()->default(null)->after('real_delivery_time');
        });
        /*
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('id_delivery_user')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
        */

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //$table->dropForeign('orders_id_delivery_user_foreign');
            $table->dropColumn('id_delivery_user');
        });
    }
}

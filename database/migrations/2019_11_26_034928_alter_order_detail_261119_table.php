<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderDetail261119Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->unsignedInteger('id_delivery_user')->nullable()->default(null)->after('real_delivery_time');
        });
        /*
        Schema::table('order_detail', function (Blueprint $table) {
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
        Schema::table('order_detail', function (Blueprint $table) {
            //$table->dropForeign('order_detail_id_delivery_user_foreign');
            $table->dropColumn('id_delivery_user');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->foreign('id_order')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_color')
                ->references('id')
                ->on('colors')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_print')
                ->references('id')
                ->on('prints')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_defect')
                ->references('id')
                ->on('defects')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_service')
                ->references('id')
                ->on('services')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_order_detail_status')
                ->references('id')
                ->on('order_detail_status')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_detail', function (Blueprint $table) {
            $table->dropForeign('order_detail_id_order_foreign');
            $table->dropForeign('order_detail_id_color_foreign');
            $table->dropForeign('order_detail_id_print_foreign');
            $table->dropForeign('order_detail_id_defect_foreign');
            $table->dropForeign('order_detail_id_service_foreign');
            $table->dropForeign('order_detail_id_order_detail_status_foreign');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->foreign('id_order')
                ->references('id')
                ->on('orders')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_assigned_user')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('day_pickup')
                ->references('day')
                ->on('calendar')
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
        Schema::table('pickups', function (Blueprint $table) {
            $table->dropForeign('pickups_id_order_foreign');
            $table->dropForeign('pickups_id_assigned_user_foreign');
            $table->dropForeign('pickups_day_pickup_foreign');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOrderHistory151219Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_history', function (Blueprint $table) {
            $table->unsignedInteger('id_payment_status')
            ->nullable()
            ->default(null)
            ->after('id_payment_method');

            $table->string('uid', '')->default('')->after('id_payment_status');
            $table->string('payment_file', '')->default('')->after('uid');
            $table->string('voucher', '')->default('')->after('payment_file');
        });

        Schema::table('order_history', function (Blueprint $table) {
            $table->foreign('id_payment_status')
                ->references('id')
                ->on('payment_status')
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
        Schema::table('order_history', function (Blueprint $table) {
            $table->dropForeign('order_history_id_payment_status_foreign');
        });
        Schema::table('order_history', function (Blueprint $table) {
            $table->dropColumn('id_payment_status');
            $table->dropColumn('uid');
            $table->dropColumn('payment_file');
            $table->dropColumn('voucher');
        });
    }
}

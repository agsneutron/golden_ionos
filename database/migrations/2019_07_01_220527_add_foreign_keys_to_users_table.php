<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_user_type')
                ->references('id')
                ->on('user_types')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_branch_office')
                ->references('id')
                ->on('branch_offices')
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_id_user_type_foreign');
            $table->dropForeign('users_id_branch_office_foreign');
        });
    }
}

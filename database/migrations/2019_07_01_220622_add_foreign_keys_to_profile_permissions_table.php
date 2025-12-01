<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToProfilePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profile_permissions', function (Blueprint $table) {
            $table->foreign('id_user_type')
                ->references('id')
                ->on('user_types')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_module')
                ->references('id')
                ->on('modules')
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
        Schema::table('profile_permissions', function (Blueprint $table) {
            $table->dropForeign('profile_permissions_id_user_type_foreign');
            $table->dropForeign('profile_permissions_id_module_foreign');
        });
    }
}

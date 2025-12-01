<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToBranchOfficeServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branch_office_services', function (Blueprint $table) {
            $table->foreign('id_branch_office')
                ->references('id')
                ->on('branch_offices')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_service')
                ->references('id')
                ->on('services')
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
        Schema::table('branch_office_services', function (Blueprint $table) {
            $table->dropForeign('branch_office_services_id_branch_office_foreign');
            $table->dropForeign('branch_office_services_id_service_foreign');
        });
    }
}

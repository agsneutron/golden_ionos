<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToExpenseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expense_reports', function (Blueprint $table) {
            $table->foreign('id_branch_office')
                ->references('id')
                ->on('branch_offices')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_expense_concept')
                ->references('id')
                ->on('expense_concepts')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
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
        Schema::table('expense_reports', function (Blueprint $table) {
            $table->dropForeign('expense_reports_id_branch_office_foreign');
            $table->dropForeign('expense_reports_id_expense_concept_foreign');
            $table->dropForeign('expense_reports_id_user_foreign');
        });
    }
}

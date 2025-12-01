<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchOfficeServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_office_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_branch_office');
            $table->unsignedInteger('id_service');
            $table->decimal('normal_price', 8,2)->default(0);
            $table->decimal('urgent_price', 8,2)->default(0);
            $table->decimal('extra_urgent_price', 8,2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_office_services');
    }
}

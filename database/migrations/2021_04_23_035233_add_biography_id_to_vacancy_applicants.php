<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBiographyIdToVacancyApplicants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacancy_applicants', function (Blueprint $table) {
            $table->foreignId('biography_id')->nullable()->constrained('biographies')->onDelete('cascade')->after('vacancy_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacancy_applicants', function (Blueprint $table) {
            //
        });
    }
}

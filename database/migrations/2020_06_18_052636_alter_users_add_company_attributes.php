<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddCompanyAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('registration')->after('password');
            $table->text('address')->after('registration');
            $table->bigInteger('zip_code')->after('address');
            $table->bigInteger('phone')->nullable()->after('zip_code');
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
            $table->dropColumn('registration');
            $table->dropColumn('address');
            $table->dropColumn('zip_code');
            $table->dropColumn('phone');
        });
    }
}

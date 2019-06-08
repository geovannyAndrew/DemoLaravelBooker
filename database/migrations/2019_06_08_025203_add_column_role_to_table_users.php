<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRoleToTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });

        DB::table('users')->insert(
            [
                ['name' => 'Administrator','email'=>'admin@email.com','password'=>bcrypt('123456'), 'role_id'=>'1'],
                ['name' => 'User Test','email'=>'user@email.com','password'=>bcrypt('123456'), 'role_id'=>'2'],
                ['name' => 'Renter Test','email'=>'renter@email.com','password'=>bcrypt('123456'), 'role_id'=>'3']
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void 
     */
    public function down()
    {
        DB::table('users')->truncate();
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_role_id_foreign');
            $table->dropColumn('role_id');
        });
    }
}

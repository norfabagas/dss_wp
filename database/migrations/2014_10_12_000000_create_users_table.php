<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->enum('role', ['operator', 'penyeleksi'])->default('penyeleksi');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
          [
            'name' => 'operator',
            'email' => 'operator@mail.com',
            'role' => 'operator',
            'password' => bcrypt('katakunci'),
          ],
          [
            'name' => 'penyeleksi',
            'email' => 'penyeleksi@mail.com',
            'role' => 'penyeleksi',
            'password' => bcrypt('katakunci'),
          ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

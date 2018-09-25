<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('nama');
            $table->string('golongan');
            $table->string('pangkat');
            $table->string('alamat');
            $table->date('tmt');
            $table->enum('gender', ['l', 'p']);
            $table->string('pendidikan');
            $table->integer('jam_mengajar');
            $table->string('ttl');
            $table->string('masa_kerja');
            $table->timestamps();
        });

        DB::table('teachers')->insert([
          [
            'nip' => '197907202003121002',
            'nama'=> 'Khurnia widhi arini S.Pd',
            'golongan'=> 'IV A',
            'pangkat'=> 'Pembina',
            'alamat'=> 'jl.bulusan selatan 1, no.22 tembalang',
            'tmt'=>date('2015-09-01'),
            'gender'=>'p',
            'pendidikan'=>'S1/PAI',
            'jam_mengajar'=>24,
            'ttl'=>'magelang, 30/06/1993',
            'masa_kerja'=>'2 tahun 3 bulan',
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
        Schema::dropIfExists('teachers');
    }
}

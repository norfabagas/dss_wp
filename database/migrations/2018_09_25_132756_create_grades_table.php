<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('teacher_id');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->integer('c1');
            $table->integer('c2');
            $table->integer('c3');
            $table->integer('c4');
            $table->integer('c5');
            $table->integer('c6');
            $table->integer('c7');
            $table->integer('c8');
            $table->integer('c9');
            $table->integer('c10');
            $table->integer('c11');
            $table->integer('c12');
            $table->integer('c13');
            $table->integer('c14');
            $table->timestamps();
        });

        DB::table('grades')->insert([
          [
            'teacher_id' => 1,
            'c1' => 3,
            'c2' => 3,
            'c3' => 3,
            'c4' => 4,
            'c5' => 3,
            'c6' => 3,
            'c7' => 3,
            'c8' => 4,
            'c9' => 3,
            'c10'=> 3,
            'c11' => 4,
            'c12' => 3,
            'c13' => 3,
            'c14' => 3,
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
        Schema::dropIfExists('grades');
    }
}

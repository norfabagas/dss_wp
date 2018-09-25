<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('grade');
            $table->timestamps();
        });

        DB::table('criterias')->insert([
          [
            'name' => 'Criteria 1',
            'grade' => 5,
          ],
          [
            'name' => 'Criteria 2',
            'grade' => 5,
          ],
          [
            'name' => 'Criteria 3',
            'grade' => 5,
          ],
          [
            'name' => 'Criteria 4',
            'grade' => 5,
          ],
          [
            'name' => 'Criteria 5',
            'grade' => 5,
          ],
          [
            'name' => 'Criteria 6',
            'grade' => 5,
          ],
          [
            'name' => 'Criteria 7',
            'grade' => 5,
          ],
          [
            'name' => 'Criteria 8',
            'grade' => 4,
          ],
          [
            'name' => 'Criteria 9',
            'grade' => 4,
          ],
          [
            'name' => 'Criteria 10',
            'grade' => 4,
          ],
          [
            'name' => 'Criteria 11',
            'grade' => 3,
          ],
          [
            'name' => 'Criteria 12',
            'grade' => 3,
          ],
          [
          'name' => 'Criteria 13',
          'grade' => 4,
          ],
          [
          'name' => 'Criteria 14',
          'grade' => 4,
          ],
          ]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('criterias');
    }
}

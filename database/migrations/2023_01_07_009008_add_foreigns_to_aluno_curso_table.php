<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aluno_curso', function (Blueprint $table) {
            $table
                ->foreign('curso_id')
                ->references('id')
                ->on('curso')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('aluno_id')
                ->references('id')
                ->on('aluno')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aluno_curso', function (Blueprint $table) {
            $table->dropForeign(['curso_id']);
            $table->dropForeign(['aluno_id']);
        });
    }
};

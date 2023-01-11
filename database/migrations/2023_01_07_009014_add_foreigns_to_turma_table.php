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
        Schema::table('turma', function (Blueprint $table) {
            $table
                ->foreign('disciplina_id')
                ->references('id')
                ->on('disciplina')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('professor_id')
                ->references('id')
                ->on('professor')
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
        Schema::table('turma', function (Blueprint $table) {
            $table->dropForeign(['disciplina_id']);
            $table->dropForeign(['professor_id']);
        });
    }
};

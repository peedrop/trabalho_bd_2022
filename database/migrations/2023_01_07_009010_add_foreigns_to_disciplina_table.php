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
        Schema::table('disciplina', function (Blueprint $table) {
            $table
                ->foreign('curso_id')
                ->references('id')
                ->on('curso')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('departamento_id')
                ->references('id')
                ->on('departamento')
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
        Schema::table('disciplina', function (Blueprint $table) {
            $table->dropForeign(['curso_id']);
            $table->dropForeign(['departamento_id']);
        });
    }
};

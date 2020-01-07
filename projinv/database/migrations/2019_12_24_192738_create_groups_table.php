<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * CLASSE MIGRATION É QUEM VAI CRIAR A TABELA groups NO BANCO DE DADOS
 */

class CreateGroupsTable extends Migration
{

	public function up()
	{
		Schema::create('groups',	function(Blueprint $table)
									{
										$table->increments('id');
										$table->string('name'); // NOME DO GRUPO
										$table->unsignedInteger('user_id');
										$table->unsignedInteger('institution_id');
										$table->timestamps();
										
										// apaga o registro (registro não é apagado no banco, mas para a aplicação ele é setado como excluido)
										$table->softDeletes();


										// DEFININDO AS CHAVES ESTRANGEIRAS
										
										// RELACIONAMENTO groups-users
										$table->foreign('user_id')->references('id')->on('users');
										// RELACIONAMENTO groups-institution
										$table->foreign('institution_id')->references('id')->on('institutions');


									});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}
}

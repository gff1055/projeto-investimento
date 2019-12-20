<?php

/**
 * CLASSE MIGRATION É QUEM VAI CRIAR A TABELA Institutions NO BANCO DE DADOS
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{

	public function up()
	{
		Schema::create('institutions',	function(Blueprint $table)
										{
											$table->increments('id');

											// NOME DA INSTITUIÇÃO
											$table->string('name');

											$table->timestamps();
										});
	}

	public function down()
	{
		Schema::drop('institutions');
	}
}

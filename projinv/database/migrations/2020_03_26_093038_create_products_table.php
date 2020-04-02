<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration{	// Migration para a tabela de produtos

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('institution_id');	// Chave estrangeira do relacionamento 'produto-instituicao'
			$table->string('name',45);					// Nome do produto
			$table->text('description');				// Descricao do produto
			$table->text('index');						// Nome do indexador (Poupanca, CDI....)
			$table->decimal('interest_rate');			// Taxa de juros
						
			$table->timestampsTz();						// Timestams com TieZone
			$table->softDeletes();

			$table->foreign('institution_id')->references('id')->on('institutions');	// Fazendo o relacionamento com 'Institution'
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::dropIfExists('products');
	}
}

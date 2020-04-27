<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimentsTable extends Migration{

	public function up(){

		Schema::create('moviments', function(Blueprint $table) {	// Esquema da tabela moviments
			$table->increments('id');			// id do movimento
			$table->unsignedInteger('user_id');	// dono da operacao
			$table->unsignedInteger('group_id');	// id do grupo
			$table->unsignedInteger('product_id');	// id do produto
			$table->decimal('value');			// valor investido
			$table->integer('type');			// entrada ou retirada

			$table->timestampsTz();
			$table->softDeletes();

			$table->foreign('user_id')->references('id')->on('users');	// chave estrangeira para a tabela usuarios
			$table->foreign('group_id')->references('id')->on('groups');	// chave estrangeira para a tabela grupos
			$table->foreign('product_id')->references('id')->on('products');	// chave estrangeira para a tabela produtos

            
		});
	}

	public function down(){
		Schema::drop('moviments');
	}
}

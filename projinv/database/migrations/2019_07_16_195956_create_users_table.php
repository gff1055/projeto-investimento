<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	/* Onde as tabelas sao criadas via migrate*/
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');

            // Dados de pessoa
            $table->char('cpf',11)->unique()->nullable();
            $table->string('name',50);
			$table->char('phone',11);
			$table->date('birth')->nullable();
			$table->char('gender',1)->nullable();
			$table->text('notes')->nullable();
			
			// Dados de autenticacao
			$table->string('email',80)->unique();
			$table->string('password',254)->nullable();

			// campos de permissao
			$table->string('status')->default('active'); //definindo valor default do campo
			$table->string('permission')->default('app.user'); //definindo padrao de permissao (app.user)

			$table->rememberToken(); // cria campo para redefinicao de senha
            $table->timestamps();	// cria dois campos (created_at e updated_at) (criacao e atualizacao de regitros)
            $table->softDeletes(); // apaga o registro (registro não é apagado no banco, mas para a aplicação ele é setado como excluido)


		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */

	/* Onde as tabelas sao removidas */
	public function down()
	{
		/* Indica que sera feita uma alteracao na tabela
		Será usado na hora de inserir os relacionamentos */
		Schema::table('users', function(Blueprint $table) {

		});

		Schema::drop('users');
	}
}

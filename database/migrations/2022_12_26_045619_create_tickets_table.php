<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('project_id');
			$table->unsignedBigInteger('category_id');
			$table->unsignedBigInteger('priority_id');
			$table->unsignedBigInteger('status_id');
			$table->unsignedBigInteger('reported_by_user_id');
			$table->unsignedBigInteger('assigned_to_user_id')->nullable();
			$table->string('summary');
			$table->longText('description');
			$table->string('tags')->nullable();
			$table->date('submitted_at');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tickets');
	}

};

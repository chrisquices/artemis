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
		Schema::create('notes', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('ticket_id');
			$table->unsignedBigInteger('user_id');
			$table->text('content');
			$table->boolean('is_reporter');
			$table->boolean('is_assigned');
			$table->boolean('is_supervisor');
			$table->timestamp('submitted_at');
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
		Schema::dropIfExists('notes');
	}

};

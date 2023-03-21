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
		Schema::create('announcements', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->string('title');
			$table->text('message');
			$table->date('submitted_at');
			$table->boolean('is_active');
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
		Schema::dropIfExists('announcements');
	}

};

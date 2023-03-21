<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$categories = [
			[
				"name" => 'General',
			],
			[
				"name" => 'Bug Fix',
			],
			[
				"name" => 'Feature',
			],
			[
				"name" => 'Hotfix',
			],
		];

		foreach ($categories as $category) {
			$new_category = new Category();
			$new_category->name = $category['name'];
			$new_category->is_active = 1;
			$new_category->save();
		}

	}

}

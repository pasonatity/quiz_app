<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
//             TestMstPublicTypesTableSeeder::class,
             TestMstTagsTableSeeder::class,
//             TestQuizzesTableSeeder::class,
//             TestQuestionsTableSeeder::class,
//             TestItemsTableSeeder::class,
//             TestResultsTableSeeder::class,
//             TestTagsTableSeeder::class
         ]);
    }
}

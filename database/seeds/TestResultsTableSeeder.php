<?php

use Illuminate\Database\Seeder;

class TestResultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results = [
            [1, 0, 'soso...'],
            [1, 2, 'good!'],
            [1, 3, 'perfect!!!']
        ];
        foreach ($results as $result) {
            DB::table('results')->insert([
                'quiz_id' => $result[0],
                'correct_number' => $result[1],
                'comment' => $result[2]
            ]);
        }
    }
}

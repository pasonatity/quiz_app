<?php

use Illuminate\Database\Seeder;

class TestQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            [1, 'question1'],
            [1, 'question2'],
            [1, 'question3']
        ];
        foreach ($questions as $question) {
            DB::table('questions')->insert([
                'quiz_id' => $question[0],
                'question_content' => $question[1]
            ]);
        }
    }
}

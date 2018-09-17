<?php

use Illuminate\Database\Seeder;

class TestQuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quizzes = [
            ['testTitle1', 'testSubTitle1', true],
            ['testTitle2', 'testSubTitle2', false]
        ];
        foreach ($quizzes as $quiz) {
            DB::table('quizzes')->insert([
                'quiz_title' => $quiz[0],
                'quiz_sub_title' => $quiz[1],
                'published' => $quiz[2]
            ]);
        }
    }
}

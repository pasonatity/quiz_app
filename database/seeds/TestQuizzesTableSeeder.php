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
        // 公開データ
        $this->insert('testTitle1', 'testSubTitle1', 1, 2);

        // 非公開データ
//        for ($i = 2; $i <= 10; $i++) {
//            $this->insert('testTitle'. $i, 'testSubTitle'. $i, 3, 2);
//        }
    }

    private function insert($title, $sub_title, $public_type, $sort)
    {
        DB::table('quizzes')->insert([
            'quiz_title' => $title,
            'quiz_sub_title' => $sub_title,
            'public_type' => $public_type,
            'question_number' => $sort
        ]);
    }
}

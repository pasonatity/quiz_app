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
        $this->insert('testTitle1', 'testSubTitle1', true);

        // 非公開データ
        for ($i = 2; $i <= 30; $i++) {
            $this->insert('testTitle'. $i, 'testSubTitle'. $i, false);
        }
    }

    private function insert($title, $sub_title, $published)
    {
        DB::table('quizzes')->insert([
            'quiz_title' => $title,
            'quiz_sub_title' => $sub_title,
            'published' => $published
        ]);
    }
}

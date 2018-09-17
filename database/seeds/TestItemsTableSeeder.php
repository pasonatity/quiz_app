<?php

use Illuminate\Database\Seeder;

class TestItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [1, 'question1_item1', true],
            [1, 'question1_item2', false],
            [1, 'question1_item3', false],
            [1, 'question1_item4', false],
            [2, 'question2_item1', true],
            [2, 'question2_item2', false],
            [2, 'question2_item3', false],
            [2, 'question2_item4', false],
            [3, 'question3_item1', true],
            [3, 'question3_item2', false],
            [3, 'question3_item3', false],
            [3, 'question3_item4', false]
        ];
        foreach ($items as $item) {
            DB::table('items')->insert([
                'question_id' => $item[0],
                'item_content' => $item[1],
                'correct' => $item[2]
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class TestTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [1, 1],
        ];
        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'quiz_id' => $tag[0],
                'mst_tag_id' => $tag[1]
            ]);
        }
    }
}

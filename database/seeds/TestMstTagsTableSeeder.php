<?php

use Illuminate\Database\Seeder;

class TestMstTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['tag1','tag2','tag3'];
        foreach ($tags as $tag) {
            DB::table('mst_tags')->insert(['tag_name' => $tag]);
        }
    }
}

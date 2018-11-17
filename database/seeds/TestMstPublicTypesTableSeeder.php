<?php

use Illuminate\Database\Seeder;

class TestMstPublicTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $public_types = [
            [1, '一般公開'],
            [2, '限定公開'],
            [3, '非公開']
        ];
        foreach ($public_types as $public_type) {
            DB::table('mst_public_types')->insert([
                'id' => $public_type[0],
                'public_type_name' => $public_type[1]
            ]);
        }

    }
}

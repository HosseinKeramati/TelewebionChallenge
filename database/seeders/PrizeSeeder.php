<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $prizesWithWeights = [
            'A' => 10,
            'B' => 30,
            'C' => 20,
            'D' => 15,
            'E' => 25,
        ];

        # create the array
        $prizeMap = [];
        foreach ($prizesWithWeights as $prize => $weight) {
            for ($i = 1; $i <= $weight; $i++) {
                $prizeMap[] = $prize;
            }
        }

        file_put_contents('prizeMap.txt', json_encode($prizeMap));
    }
}

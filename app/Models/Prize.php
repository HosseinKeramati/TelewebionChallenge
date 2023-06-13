<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    use HasFactory;

    public function getPrizesMap()
    {
        if (!file_exists(base_path('prizeMap.txt'))) {
            return response()->json(['ok' => false, 'msg' => 'Server Error! Run Seeders'], 500);
        }
        return json_decode(file_get_contents(base_path('prizeMap.txt')), true);
    }

    public function calculateUserPrize()
    {
        $prizeMap = $this->getPrizesMap();

        $index = rand(1, 100) - 1;

        return $prizeMap[$index];

    }
}

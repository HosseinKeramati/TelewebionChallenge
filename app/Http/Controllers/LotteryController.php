<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class LotteryController extends Controller
{

    public function performLottery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'UUID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['ok' => false, 'msg' => 'User Required'], 400);
        }
        $uuid = $request->UUID;

        $user = new User($uuid);
        $userCanPerformLottery = $user->userCanPerformLottery();

        if (!$userCanPerformLottery) {
            return response()->json(['ok' => false, 'msg' => 'Come back tomorrow'], 400);
        }

        $prize = new Prize();
        $userPrize = $prize->calculateUserPrize();
        $user->storeUserPrize($userCanPerformLottery, $userPrize);

        return response()->json(['ok' => true, 'msg' => 'Congrats!', 'prize' => $userPrize], 200);

    }

}

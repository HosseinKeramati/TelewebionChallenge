<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class UserPerformLotteryTest extends TestCase
{

    public function testUserCanPerformLottery(): void
    {
        $user = new User('f1bc8f04-0500-11ee-be56-0242ac120002');
        $user->setUserDataInRedis(3, ['A', 'B', 'C']);

        $res = $user->userCanPerformLottery();

        $this->assertFalse($res);
        Redis::del('f1bc8f04-0500-11ee-be56-0242ac120002');

        $user = new User('f1bc8f04-0500-11ee-be56-0242ac120002');
        $user->setUserDataInRedis(1, ['A']);

        $res = $user->userCanPerformLottery();

        $this->assertIsArray($res);

    }
}

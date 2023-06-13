<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class UserPerformLotteryTest extends TestCase
{

    public function testInvalidUuid(): void
    {
        $response = $this->post('/api/v1/lottery');

        $response->assertStatus(400);
    }

    public function testTooManyAttemptScenario(): void
    {

        $user = new User('f1bc8f04-0500-11ee-be56-0242ac120002');
        $res = $user->setUserDataInRedis(3, ['A', 'B', 'C']);

        $response = $this->post('/api/v1/lottery', ['UUID' => 'f1bc8f04-0500-11ee-be56-0242ac120002']);

        $response->assertStatus(400);
        Redis::del('f1bc8f04-0500-11ee-be56-0242ac120002');
    }

    public function testSuccesstScenario(): void
    {

        $user = new User('f1bc8f04-0500-11ee-be56-0242ac120002');
        $res = $user->setUserDataInRedis(1, ['A']);

        $response = $this->post('/api/v1/lottery', ['UUID' => 'f1bc8f04-0500-11ee-be56-0242ac120002']);

        $response->assertStatus(200);
        Redis::del('f1bc8f04-0500-11ee-be56-0242ac120002');

    }
}

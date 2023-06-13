<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Redis;

class User extends Authenticatable
{
    use HasFactory;

    protected $uuid;

    public function __construct($uuid)
    {
        $this->uuid = $uuid;
    }

    public function storeUserPrize($userData, $userPrize)
    {
        if (date('Y-m-d') == $userData['date']) {
            $tries = $userData['todayTries'];
            $todayPrizes = $userData['todayPrizes'];
            $todayPrizes[] = $userPrize;

            return $this->setUserDataInRedis(++$tries, $todayPrizes);
        } else {

            return $this->setUserDataInRedis(1, [$userPrize]);
        }

    }

    public function setUserDataInRedis($todayTries, $todayPrizes)
    {
        Redis::set($this->uuid, json_encode(['date' => date('Y-m-d'), 'todayTries' => $todayTries, 'todayPrizes' => $todayPrizes]));

        return json_decode(Redis::get($this->uuid), true);
    }

    public function getUserDataFromRedis()
    {
        $userData = Redis::get($this->uuid);

        if (!$userData) {
            Redis::set($this->uuid, json_encode(['date' => date('Y-m-d'), 'todayTries' => 0, 'todayPrizes' => []]));
        }

        return json_decode(Redis::get($this->uuid), true);
    }

    public function userCanPerformLottery()
    {
        $userData = $this->getUserDataFromRedis();

        if (date('Y-m-d') == $userData['date']) {
            $tries = $userData['todayTries'];
            if ($tries >= 3) {
                return false;
            }
        }
        return $userData;

    }

}

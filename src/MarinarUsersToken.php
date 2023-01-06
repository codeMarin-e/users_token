<?php
namespace Marinar\UsersToken;

use Marinar\UsersToken\Database\Seeders\MarinarUsersTokenCleanInjectsSeeder;
use Marinar\UsersToken\Database\Seeders\MarinarUsersTokenInjectsSeeder;

class MarinarUsersToken {

    public static function getPackageMainDir() {
        return __DIR__;
    }

    public static function cleanInjects() {
        return MarinarUsersTokenCleanInjectsSeeder::class;
    }

    public static function injects() {
        return MarinarUsersTokenInjectsSeeder::class;
    }
}

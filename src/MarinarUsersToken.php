<?php
namespace Marinar\UsersToken;

use Marinar\UsersToken\Database\Seeders\MarinarUsersTokenInstallSeeder;

class MarinarUsersToken {

    public static function getPackageMainDir() {
        return __DIR__;
    }

    public static function injects() {
        return MarinarUsersTokenInstallSeeder::class;
    }
}

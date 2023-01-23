<?php
    namespace Marinar\UsersToken\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Marinar\UsersToken\MarinarUsersToken;

    class MarinarUsersTokenInstallSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public function run() {

            if(!in_array(env('APP_ENV'), ['dev', 'local'])) return;
            static::$packageName = 'marinar_users_token';
            static::$packageDir = MarinarUsersToken::getPackageMainDir();

            $this->autoInstall();

            $this->refComponents->info("Done!");
        }
    }

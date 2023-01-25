<?php
    namespace Marinar\UsersToken\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Marinar\UsersToken\MarinarUsersToken;

    class MarinarUsersTokenRemoveSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public static function configure() {
            static::$packageName = 'marinar_users_token';
            static::$packageDir = MarinarUsersToken::getPackageMainDir();
        }

        public function run() {
            if(!in_array(env('APP_ENV'), ['dev', 'local'])) return;

            $this->autoRemove();

            $this->refComponents->info("Done!");
        }

        public function clearDB() {
            $this->refComponents->task("Clear DB", function() {
                \Laravel\Sanctum\PersonalAccessToken::where('name', 'packages')->delete();
                return true;
            });
        }
    }

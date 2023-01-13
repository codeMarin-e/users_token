<?php
    namespace Marinar\UsersToken\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Marinar\UsersToken\MarinarUsersToken;

    class MarinarUsersTokenInstallSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public function run() {
            $this->getRefComponents();

            $this->stubFiles();
            $this->dbMigrate();

            $this->call([
                \Marinar\UsersToken\Database\Seeders\MarinarUsersTokenCleanInjectsSeeder::class,
                \Marinar\UsersToken\Database\Seeders\MarinarUsersTokenInjectsSeeder::class,
            ]);
            $this->refComponents->info("Done!");
        }

        private function stubFiles() {
            $this->copyStubs(MarinarUsersToken::getPackageMainDir().DIRECTORY_SEPARATOR.'stubs');
        }

        private function dbMigrate() {
            $this->dbMigrateDir(implode(DIRECTORY_SEPARATOR, [
                MarinarUsersToken::getPackageMainDir(),
                'stubs', 'project', 'database', 'migrations',
            ]));
        }


    }

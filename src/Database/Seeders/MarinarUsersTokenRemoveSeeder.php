<?php
    namespace Marinar\UsersToken\Database\Seeders;

    use App\Models\Package;
    use Illuminate\Database\Seeder;
    use Marinar\UsersToken\MarinarUsersToken;
    use Symfony\Component\Process\Exception\ProcessFailedException;
    use Symfony\Component\Process\Process;

    class MarinarUsersTokenRemoveSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public function run() {
            $this->getRefComponents();

            $this->dbMigrateRollback();
            $this->clearDB();
            $this->clearFiles();

            $this->call([
                \Marinar\UsersToken\Database\Seeders\MarinarUsersTokenCleanInjectsSeeder::class,
            ]);

            $this->refComponents->info("Done!");
        }

        private function dbMigrateRollback() {
            $this->dbMigrateRollbackDir(implode(DIRECTORY_SEPARATOR, [
                MarinarUsersToken::getPackageMainDir(),
                'stubs', 'project', 'database', 'migrations',
            ]));
        }

        public function clearDB() {
            $this->refComponents->task("Clear DB", function() {
                \Laravel\Sanctum\PersonalAccessToken::where('name', 'packages')->delete();
                return true;
            });
        }

        private function clearFiles() {
//            if(!$this->command->confirm('Are you sure you want to delete `users token` files?', true)) return false;
            $this->refComponents->task("Clear stubs", function() {
                $copyDir = MarinarUsersToken::getPackageMainDir().DIRECTORY_SEPARATOR.'stubs';
                static::removeStubFiles($copyDir, $copyDir, true);
                return true;
            });
        }
    }

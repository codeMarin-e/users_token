<?php
    namespace Marinar\UsersToken\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Marinar\UsersToken\MarinarUsersToken;

    class MarinarUsersTokenCleanInjectsSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public $injectClass = '';

        public function run() {
            $this->injectClass = MarinarUsersToken::injects();

            $this->getRefComponents();

            $this->clearAddonInjects();
        }

        private function clearAddonInjects() {
            $this->refComponents->task("Clear addon inject - User model", function(){
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Models', 'User.php']);
                if(!realpath($filePath)) return false;
                if(!file_put_contents($filePath, $this->removeFromContent($filePath, ["use \\Marinar\\UsersToken\\Traits\\UserTokenTrait;"])))
                    return false;
                return true;
            });

            $this->refComponents->task("Clear addon inject - UserController.php", function(){
                $checkHooks = [
                    implode(DIRECTORY_SEPARATOR, [MarinarUsersToken::getPackageMainDir(), 'hooks', 'olds', 'HOOK_USERS_STORE_END-v0.0.99.php']),
                    implode(DIRECTORY_SEPARATOR, [MarinarUsersToken::getPackageMainDir(), 'hooks', 'HOOK_USERS_STORE_END.php']), //latest
                ];
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Http', 'Controllers', 'Admin', 'UserController.php']);
                if(!realpath($filePath)) return false;
                foreach($checkHooks as $hookPath) {
                    if(!realpath($hookPath)) continue;
                    if(!file_put_contents($filePath, $this->removeFromContent($filePath, $this->hookLines($hookPath))))
                        continue;
                }
                return true;
            });

            $this->refComponents->task("Clear addon inject - user.blade.php", function(){
                $checkHooks = [
                    implode(DIRECTORY_SEPARATOR, [MarinarUsersToken::getPackageMainDir(), 'hooks', 'HOOK_USER_AFTER_ROLES.blade.php']), //latest
                ];
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'resources', 'views', 'admin', 'users', 'user.blade.php']);
                if(!realpath($filePath)) return false;
                foreach($checkHooks as $hookPath) {
                    if(!realpath($hookPath)) continue;
                    if(!file_put_contents($filePath, $this->removeFromContent($filePath, $this->hookLines($hookPath))))
                        continue;
                }
                return true;
            });

            $this->refComponents->task("Clear addon inject - lang user.php", function(){
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'lang', 'en', 'admin', 'users', 'user.php']);
                if(!realpath($filePath)) return false;
                if(!file_put_contents($filePath,  $this->removeFromContent($filePath, ["'packages_token' => 'Package Token',"])))
                    return false;
                return true;
            });

            $this->refComponents->task("Clear addon inject - marinar_users.php", function(){
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'config','marinar_users.php']);
                if(!realpath($filePath)) return false;
                if(!file_put_contents($filePath,  $this->removeFromContent($filePath, ["\\Marinar\\UsersToken\\MarinarUsersToken::class,"])))
                    return false;
                return true;
            });

        }
    }

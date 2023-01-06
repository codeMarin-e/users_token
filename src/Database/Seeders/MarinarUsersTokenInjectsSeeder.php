<?php
    namespace Marinar\UsersToken\Database\Seeders;

    use App\Models\Package;
    use Illuminate\Database\Seeder;
    use Marinar\UsersToken\MarinarUsersToken;
    use Symfony\Component\Process\Exception\ProcessFailedException;
    use Symfony\Component\Process\Process;

    class MarinarUsersTokenInjectsSeeder extends Seeder {

        use \Marinar\Marinar\Traits\MarinarSeedersTrait;

        public function run() {
            $this->getRefComponents();

            $this->injectAddon();
        }

        private function injectAddon() {
            $this->refComponents->task("Inject addon - User model", function(){
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Models', 'User.php']);
                if(!realpath($filePath)) return false;
                if(!file_put_contents($filePath, $this->putBeforeInContent(
                    $filePath, "// @HOOK_USER_TRAITS", "\tuse \\Marinar\\UsersToken\\Traits\\UserTokenTrait; \n"
                ))) return false;
                return true;
            });

            $this->refComponents->task("Inject addon - UserController", function(){
                $hookPath = implode(DIRECTORY_SEPARATOR, [MarinarUsersToken::getPackageMainDir(), 'hooks', 'HOOK_USERS_STORE_END.php']);
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Http', 'Controllers', 'Admin', 'UserController.php']);
                if(!realpath($hookPath) || !realpath($filePath)) return false;
                $hookContent = str_replace("<?php\n", '', file_get_contents($hookPath) );
                if(!file_put_contents($filePath, $this->putBeforeInContent(
                    $filePath,["// @HOOK_USERS_STORE_END", "// @HOOK_USERS_UPDATE_END"], $hookContent
                ))) return false;
                return true;
            });

            $this->refComponents->task("Inject addon - user.blade.php", function(){
                $hookPath = implode(DIRECTORY_SEPARATOR, [MarinarUsersToken::getPackageMainDir(), 'hooks', 'HOOK_USER_AFTER_ROLES.blade.php']);
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'resources', 'views', 'admin', 'users', 'user.blade.php']);
                if(!realpath($hookPath) || !realpath($filePath)) return false;
                $hookContent = file_get_contents($hookPath);

                if(!file_put_contents($filePath, $this->putBeforeInContent(
                    $filePath, "{{-- @HOOK_USER_AFTER_ROLES --}}", $hookContent
                ))) return false;
                return true;
            });

            $this->refComponents->task("Inject addon - lang user.php", function(){
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'lang', 'en', 'admin', 'users', 'user.php']);
                if(!realpath($filePath)) return false;
                if(!file_put_contents($filePath, $this->putBeforeInContent(
                    $filePath, "// @HOOK_USER_LANG", "\t'packages_token' => 'Package Token', \n"
                ))) return false;
                return true;
            });


            $this->refComponents->task("Inject addon - marinar_users.php", function(){
                $filePath = implode(DIRECTORY_SEPARATOR, [ base_path(), 'config','marinar_users.php']);
                if(!realpath($filePath)) return false;
                if(!file_put_contents($filePath, $this->putBeforeInContent(
                    $filePath, "// @HOOK_USER_CONFIGS_ADDONS", "\t\t\\Marinar\\UsersToken\\MarinarUsersToken::class, \n"
                ))) return false;
                return true;
            });

        }

    }

<?php
return [
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Models', 'User.php']) => [
        "// @HOOK_TRAITS" => "\tuse \\App\\Traits\\UserTokenTrait; \n",
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'app', 'Http', 'Controllers', 'Admin', 'UserController.php']) => [
        "// @HOOK_USERS_STORE_END" => implode(DIRECTORY_SEPARATOR, [__DIR__, 'HOOK_USERS_STORE_END.php']),
        "// @HOOK_USERS_UPDATE_END" => implode(DIRECTORY_SEPARATOR, [__DIR__, 'HOOK_USERS_STORE_END.php']),
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'resources', 'views', 'admin', 'users', 'user.blade.php']) => [
        "{{-- @HOOK_USER_AFTER_ROLES --}}" => implode(DIRECTORY_SEPARATOR, [__DIR__, 'HOOK_USER_AFTER_ROLES.blade.php']),
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'lang', 'en', 'admin', 'users', 'user.php']) => [
        "// @HOOK_USER_LANG" => "\t'packages_token' => 'Package Token', \n",
    ],
    implode(DIRECTORY_SEPARATOR, [ base_path(), 'config','marinar_users.php']) => [
        "// @HOOK_USER_CONFIGS_ADDONS" => "\t\t\\Marinar\\UsersToken\\MarinarUsersToken::class, \n",
    ],
];

<?php
//    $dbDir = [ dirname(__DIR__), 'Database', 'migrations' ];
//    $dbDir = implode( DIRECTORY_SEPARATOR, $dbDir );
	return [
		'install' => [
            'php artisan db:seed --class="\Marinar\UsersToken\Database\Seeders\MarinarUsersTokenInstallSeeder"',
		],
		'remove' => [
            'php artisan db:seed --class="\Marinar\UsersToken\Database\Seeders\MarinarUsersTokenRemoveSeeder"',
        ]
	];

<?php
	return [
		'install' => [
            'php artisan db:seed --class="\Marinar\UsersToken\Database\Seeders\MarinarUsersTokenInstallSeeder"',
		],
		'remove' => [
            'php artisan db:seed --class="\Marinar\UsersToken\Database\Seeders\MarinarUsersTokenRemoveSeeder"',
        ]
	];

<?php
    namespace Marinar\UsersToken\Traits;

    trait UserTokenTrait {

        public static function bootUserTokenTrait() {
            static::$addonFillable[] = 'packages_token';
        }
    }

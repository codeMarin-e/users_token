<?php
return [
    /**
     * Behavior when package is installed or update
     * true - normal
     * false - do not do anything
     */
    'install_behavior' => env('MARINAR_USERS_TOKEN_INSTALL_BEHAVIOR', env('MARINAR_INSTALL_BEHAVIOR', true)),

    /**
     * Behavior when package is removed from composer
     * true - delete all
     * false - delete all, but not changed stubs files
     * 1 - delete all, but keep the stub files and injection
     * 2 - keep everything
     */
    'delete_behavior' => env('MARINAR_USERS_TOKEN_DELETE_BEHAVIOR', env('MARINAR_DELETE_BEHAVIOR', false)),

    /**
     * File stubs that return arrays that are configurable,
     * If path is directory - its files and sub directories
     */
    'values_stubs' => [
        __DIR__,
    ],

    /**
     * Exclude stubs to be updated
     * If path is directory - exclude all its files
     * If path is file - only it
     */
    'exclude_stubs' => [
    ],

    /**
     * Exclude addon injections
     * file_path => [ '@hook1', '@hook2' ]
     * file_path => * - all from this file
     */
    'exclude_injects' => [],

    /**
     * Addons hooked to the package
     */
    'addons' => [
        // @HOOK_USER_CONFIGS_ADDONS
    ],
    // @HOOK_USER_CONFIGS
];

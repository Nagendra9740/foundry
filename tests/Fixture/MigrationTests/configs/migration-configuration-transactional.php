<?php

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'migrations_paths' => [
        'Zenstruck\\Foundry\\Tests\\Fixture\\MigrationTests\\Migrations' => \dirname(__DIR__).'/Migrations',
    ],
    'transactional' => true,
];

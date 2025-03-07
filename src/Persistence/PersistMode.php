<?php

declare(strict_types=1);

/*
 * This file is part of the zenstruck/foundry package.
 *
 * (c) Kevin Bond <kevinbond@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zenstruck\Foundry\Persistence;

/**
 * @internal
 * @author Nicolas PHILIPPE <nikophil@gmail.com>
 */
enum PersistMode
{
    case PERSIST;
    case WITHOUT_PERSISTING;
    case NO_PERSIST_BUT_SCHEDULE_FOR_INSERT;

    public function isPersisting(): bool
    {
        return self::PERSIST === $this;
    }
}

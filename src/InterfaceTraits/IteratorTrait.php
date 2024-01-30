<?php

/**
 * PHP Basics
 *
 * Copyright (C) 2024 Sebastian Meyer <sebastian.meyer@opencultureconsulting.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace OCC\Basics\InterfaceTraits;

use Iterator;

/**
 * A generic implementation of the Iterator interface.
 *
 * @author Sebastian Meyer <sebastian.meyer@opencultureconsulting.com>
 * @package Basics\InterfaceTraits
 *
 * @api
 *
 * @template TValue of mixed
 * @implements Iterator<TValue>
 * @phpstan-require-implements Iterator
 */
trait IteratorTrait
{
    /**
     * Holds the iterable data.
     *
     * @var array<TValue>
     */
    protected array $data = [];

    /**
     * Return the current item.
     *
     * @return ?TValue The current item or NULL if invalid
     *
     * @internal
     */
    public function current(): mixed
    {
        if ($this->valid()) {
            /** @var TValue */
            return current($this->data);
        }
        return null;
    }

    /**
     * Return the current key.
     *
     * @return ?array-key The current key or NULL if invalid
     *
     * @internal
     */
    public function key(): mixed
    {
        return key($this->data);
    }

    /**
     * Move forward to next item.
     *
     * @return void
     *
     * @internal
     */
    public function next(): void
    {
        next($this->data);
    }

    /**
     * Rewind the iterator to the first item.
     *
     * @return void
     *
     * @internal
     */
    public function rewind(): void
    {
        reset($this->data);
    }

    /**
     * Check if current position is valid.
     *
     * @return bool Whether the current position is valid
     *
     * @internal
     */
    public function valid(): bool
    {
        return !is_null($this->key());
    }
}

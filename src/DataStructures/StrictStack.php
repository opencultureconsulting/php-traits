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

namespace OCC\Basics\DataStructures;

use RuntimeException;

/**
 * A type-sensitive, taversable Last In, First Out Stack (LIFO).
 *
 * Extends [\SplStack](https://www.php.net/splstack) with an option to specify
 * the allowed data types for list items.
 *
 * @author Sebastian Meyer <sebastian.meyer@opencultureconsulting.com>
 * @package Basics\DataStructures
 *
 * @property-read string[] $allowedTypes
 *
 * @template AllowedType of mixed
 * @extends StrictList<AllowedType>
 */
class StrictStack extends StrictList
{
    /**
     * Add an item to the stack.
     *
     * @param AllowedType $item The item to stack
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function stack(mixed $item): void
    {
        parent::push($item);
    }

    /**
     * Unstack an item from the stack.
     *
     * @return AllowedType The unstacked item
     */
    public function unstack(): mixed
    {
        return parent::pop();
    }

    /**
     * Set the mode of iteration.
     *
     * @param int $mode The new iterator mode (2 or 3)
     *
     * @return int The set of flags and modes of iteration
     *
     * @throws RuntimeException
     */
    final public function setIteratorMode(int $mode): int
    {
        if ($mode < 2) {
            throw new RuntimeException(
                sprintf(
                    'Changing the iterator direction of %s is prohibited.',
                    static::class
                )
            );
        }
        return parent::setIteratorMode($mode);
    }

    /**
     * Create a type-sensitive, traversable stack of items.
     *
     * @param string[] $allowedTypes Allowed data types of items (optional)
     *                               If empty, all types are allowed.
     *                               Possible values are:
     *                               - "array"
     *                               - "bool"
     *                               - "callable"
     *                               - "countable"
     *                               - "float" or "double"
     *                               - "int" or "integer" or "long"
     *                               - "iterable"
     *                               - "null"
     *                               - "numeric"
     *                               - "object" or FQCN
     *                               - "resource"
     *                               - "scalar"
     *                               - "string"
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $allowedTypes = [])
    {
        parent::__construct($allowedTypes);
        $this->setIteratorMode(2);
    }
}

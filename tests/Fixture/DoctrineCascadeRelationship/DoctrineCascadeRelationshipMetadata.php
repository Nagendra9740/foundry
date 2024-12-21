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

namespace Zenstruck\Foundry\Tests\Fixture\DoctrineCascadeRelationship;

/**
 * @author Nicolas PHILIPPE <nikophil@gmail.com>
 */
final class DoctrineCascadeRelationshipMetadata implements \Stringable
{
    private function __construct(
        public readonly string $class,
        public readonly string $field,
        public readonly bool $cascade,
    ) {
    }

    public function __toString(): string
    {
        return \sprintf('%s::$%s - %s', $this->class, $this->field, $this->cascade ? 'cascade' : 'no cascade');
    }

    /**
     * @param array{class: class-string, field: string} $source
     */
    public static function fromArray(array $source, bool $cascade = false): self
    {
        return new self(class: $source['class'], field: $source['field'], cascade: $cascade);
    }

    /**
     * @param  list<array{class: class-string, field: string}> $relationshipFields
     * @return \Generator<list<static>>
     */
    public static function allCombinations(array $relationshipFields): iterable
    {
        // prevent too long test suite permutation when Dama is disabled
        if (!\getenv('USE_DAMA_DOCTRINE_TEST_BUNDLE')) {
            $metadata = self::fromArray($relationshipFields[0]);

            yield "{$metadata}\n" => [$metadata];

            return;
        }

        $total = 2 ** \count($relationshipFields);

        for ($i = 0; $i < $total; ++$i) {
            $temp = [];

            $permutationName = "\n";
            for ($j = 0; $j < \count($relationshipFields); ++$j) {
                $metadata = self::fromArray($relationshipFields[$j], cascade: (bool) (($i >> $j) & 1));

                $temp[] = $metadata;
                $permutationName = "{$permutationName}$metadata\n";
            }

            yield $permutationName => $temp;
        }
    }
}

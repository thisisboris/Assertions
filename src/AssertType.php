<?php

namespace Thisisboris\Assertions;

use Ds\Sequence;

readonly class AssertType implements Assertion
{
    use AssertsUsingSoftAssert;

    public function __construct(private Sequence $types)
    {}

    public function getAssertionString(): string
    {
        return sprintf('type is (one of) %s', $this->types->join(', '));
    }

    public function softAssert(mixed $value): bool
    {
        $type = gettype($value);
        if ($type === 'double' && is_float($value)) {
            $type = 'float'; // (for historical reasons "double" is returned in case of a float, and not simply "float")
        }

        return $this->types->contains($type);
    }
}
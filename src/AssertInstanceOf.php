<?php

namespace Thisisboris\Assertions;

use Ds\Sequence;

readonly class AssertInstanceOf implements Assertion
{
    use AssertsUsingSoftAssert;

    public function __construct(private Sequence $classes)
    {}

    public function getAssertionString(): string
    {
        return sprintf('object is instance of %s', $this->classes->join(', '));
    }

    public function softAssert(mixed $value): bool
    {
        if (! is_object($value)) return false;
        if ($this->classes->contains($value::class)) return true;

        foreach ($this->classes as $class) {
            if ($value instanceof $class) {
                return true;
            }
        }

        return false;
    }
}
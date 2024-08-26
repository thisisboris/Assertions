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
        return $this->types->contains(gettype($value));
    }
}
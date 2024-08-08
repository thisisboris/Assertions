<?php

namespace Thisisboris\Assertions;

use Ds\Sequence;
use Thisisboris\Assertions\Exceptions\AssertException;

readonly class AssertType implements Assertion
{
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

    public function assert(mixed $value): void
    {
        if ($this->softAssert($value)) {
            return;
        }

        throw new AssertException($this);
    }
}
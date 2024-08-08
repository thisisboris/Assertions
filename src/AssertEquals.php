<?php

namespace Thisisboris\Assertions;

use Thisisboris\Assertions\Exceptions\AssertException;

readonly class AssertEquals implements Assertion
{
    public function __construct(private mixed $source)
    {}

    public function getAssertionString(): string
    {
        return sprintf('value equals %s', $this->source);
    }

    public function softAssert(mixed $value): bool
    {
        return $this->source === $value;
    }

    public function assert(mixed $value): void
    {
        if ($this->softAssert($value)) {
            return;
        }

        throw new AssertException($this);
    }
}
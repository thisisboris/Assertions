<?php

namespace Thisisboris\Assertions;

use Ds\Sequence;
use Thisisboris\Assertions\Exceptions\AssertException;

readonly class AssertInstanceOf implements Assertion
{
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

    public function assert(mixed $value): void
    {
        if ($this->softAssert($value)) {
            return;
        }

        throw new AssertException($this);
    }
}
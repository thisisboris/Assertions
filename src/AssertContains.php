<?php

namespace Thisisboris\Assertions;

use Thisisboris\Assertions\Exceptions\AssertException;

readonly class AssertContains implements Assertion
{
    public function __construct(private Assertion $assertion)
    {}

    public function getAssertionString(): string
    {
        return sprintf('Iterable only contains %s', $this->assertion->getAssertionString());
    }

    public function softAssert(mixed $value): bool
    {
        if (! is_iterable($value)) return false;
        if (empty($value)) return true;

        foreach($value as $item) {
            if (! $this->assertion->softAssert($item)) return false;
        }

        return true;
    }

    public function assert(mixed $value): void
    {
        if (! is_iterable($value)) throw new AssertException($this);
        if (empty($value)) return;

        foreach($value as $item) {
            $this->assertion->assert($item);
        }
    }
}
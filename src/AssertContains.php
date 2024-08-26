<?php

namespace Thisisboris\Assertions;

readonly class AssertContains implements Assertion
{
    use AssertsUsingSoftAssert;

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
}
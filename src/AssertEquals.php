<?php

namespace Thisisboris\Assertions;

readonly class AssertEquals implements Assertion
{
    use AssertsUsingSoftAssert;

    public function __construct(private mixed $source)
    {}

    public function getAssertionString(): string
    {
        return sprintf('value equals %s', gettype($this->source));
    }

    public function softAssert(mixed $value): bool
    {
        return $this->source === $value;
    }
}
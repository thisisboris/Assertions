<?php

namespace Thisisboris\Assertions;

use Thisisboris\Assertions\Exceptions\AssertException;

interface Assertion
{
    public function getAssertionString(): string;

    public function softAssert(mixed $value): bool;

    /** @throws AssertException */
    public function assert(mixed $value): void;
}
<?php

namespace Thisisboris\Assertions;

use Thisisboris\Assertions\Exceptions\AssertException;

trait AssertsUsingSoftAssert
{
    public function assert(mixed $value): void
    {
        if ($this->softAssert($value)) {
            return;
        }

        throw new AssertException($this);
    }

    public abstract function softAssert(mixed $value): bool;
}
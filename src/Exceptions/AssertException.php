<?php

namespace Thisisboris\Assertions\Exceptions;

use Thisisboris\Assertions\Assertion;

class AssertException extends \RuntimeException
{
    public function __construct(private readonly Assertion $assertion)
    {
        parent::__construct(sprintf("Failed asserting %s", $assertion->getAssertionString()));
    }

    public function getAssertion(): Assertion
    {
        return $this->assertion;
    }
}
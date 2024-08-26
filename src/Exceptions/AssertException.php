<?php

namespace Thisisboris\Assertions\Exceptions;

use Thisisboris\Assertions\Assertion;

class AssertException extends \RuntimeException
{
    private Assertion $assertion;

    public function __construct(Assertion $assertion)
    {
        parent::__construct(sprintf("Failed asserting %s", $assertion->getAssertionString()));
        $this->assertion = $assertion;
    }

    protected function getAssertion(): Assertion
    {
        return $this->assertion;
    }
}
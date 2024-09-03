<?php

namespace Exceptions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Thisisboris\Assertions\Assertion;
use Thisisboris\Assertions\Exceptions\AssertException;

#[CoversClass(AssertException::class)]
class AssertExceptionTest extends TestCase
{
    #[Test]
    public function itCanReturnAssertion()
    {
        $mockAssertion = $this->createMock(Assertion::class);
        $subject = new AssertException($mockAssertion);
        $this->assertEquals($mockAssertion, $subject->getAssertion());
    }

    #[Test]
    public function itConstructsTheMessage()
    {
        $mockAssertion = $this->createMock(Assertion::class);
        $mockAssertion->expects($this->once())
            ->method('getAssertionString')
            ->willReturn('MockedAssertionString');

        $subject = new AssertException($mockAssertion);
        $this->assertEquals(sprintf('Failed asserting %s', 'MockedAssertionString'), $subject->getMessage());
    }
}
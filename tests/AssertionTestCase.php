<?php

namespace Thisisboris\Assertions\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Thisisboris\Assertions\Assertion;
use Thisisboris\Assertions\Exceptions\AssertException;

abstract class AssertionTestCase extends TestCase
{
    #[Test]
    #[DataProvider('assertionProvider')]
    public function itCanSoftAssert(array $inputs, mixed $value, bool $passes): void
    {
        $class = $this->getAssertionClass();

        /** @var Assertion $subject */
        $subject = new $class(...$inputs);

        $this->assertInstanceOf(Assertion::class, $subject);
        $this->assertEquals($passes, $subject->softAssert($value));
    }

    #[Test]
    #[DataProvider('assertionProvider')]
    public function itCanAssert(array $inputs, mixed $value, bool $passes): void
    {
        $class = $this->getAssertionClass();

        /** @var Assertion $subject */
        $subject = new $class(...$inputs);

        $this->assertInstanceOf(Assertion::class, $subject);

        try {
            $subject->assert($value);
        } catch (AssertException $assertException) {
            $this->assertInstanceOf(AssertException::class, $assertException);
            $this->assertTrue(!$passes, "Did not expect AssertionException to be thrown.");

            return; // Return as the test has succeeded.
        } catch (\Throwable $throwable) {
            $this->fail("An unknown exception was thrown: " . $throwable->getMessage());
        }

        $this->assertFalse(!$passes, "Expected AssertionException to be thrown.");
    }

    public abstract static function assertionProvider(): array;

    public abstract function getAssertionClass(): string;
}
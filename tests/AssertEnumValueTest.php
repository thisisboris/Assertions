<?php

namespace Thisisboris\Assertions\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use Thisisboris\Assertions\AssertEnumValue;
use Thisisboris\Assertions\Tests\Fixtures\EmptyEnumFixture;
use Thisisboris\Assertions\Tests\Fixtures\EnumFixture;
use Thisisboris\Assertions\Tests\Fixtures\IntBackedEnumFixture;
use Thisisboris\Assertions\Tests\Fixtures\StringBackedEnumFixture;

#[CoversClass(AssertEnumValue::class)]
class AssertEnumValueTest extends AssertionTestCase
{
    #[Test]
    public function itThrowsInvalidArgumentExceptionForEmptyEnums(): void
    {
        try {
            new AssertEnumValue(EmptyEnumFixture::class);
            $this->fail('InvalidArgumentException was not thrown');
        } catch (\Throwable $exception) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
        }
    }

    #[Test]
    public function itThrowsInvalidArgumentExceptionForNonBackedEnums(): void
    {
        try {
            new AssertEnumValue(EnumFixture::class);
            $this->fail('InvalidArgumentException was not thrown');
        } catch (\Throwable $exception) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
        }
    }

    #[Test]
    public function itThrowsInvalidArgumentExceptionForNonEnums(): void
    {
        try {
            new AssertEnumValue('NotAnEnum');
            $this->fail('InvalidArgumentException was not thrown');
        } catch (\Throwable $exception) {
            $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
        }
    }

    public static function assertionProvider(): array
    {
        return [
            'Int Backed Enum (true)' => [[IntBackedEnumFixture::class], 1, true],
            'Int Backed Enum (false)' => [[IntBackedEnumFixture::class], 1293705, false],

            'String Backed Enum (true)' => [[StringBackedEnumFixture::class], StringBackedEnumFixture::FOO->value, true],
            'String Backed Enum (false)' => [[StringBackedEnumFixture::class], 'Nope', false],

            'Case Insensitive String Backed Enum (true)' => [[StringBackedEnumFixture::class, false], 'FOO', true],
            'Case Insensitive String Backed Enum (false)' => [[StringBackedEnumFixture::class, false], 'Nope', false],
        ];
    }

    public function getAssertionClass(): string
    {
        return AssertEnumValue::class;
    }
}

<?php

namespace Thisisboris\Assertions\Tests;

use Ds\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\UsesClass;
use Thisisboris\Assertions\AssertContains;
use Thisisboris\Assertions\AssertEquals;

/**
 * @TODO: Convert to no longer depend on AssertEquals and just use a MockAssertion
 */
#[CoversClass(AssertContains::class)]
#[UsesClass(AssertEqualsTest::class)]
class AssertContainsTest extends AssertionTestCase
{
    #[Test]
    #[DataProvider('assertionProvider')]
    #[DependsExternal(AssertEqualsTest::class, 'itCanSoftAssert')]
    public function itCanSoftAssert(array $inputs, mixed $value, bool $passes): void
    {
        parent::itCanSoftAssert($inputs, $value, $passes);
    }
    #[Test]
    #[DataProvider('assertionProvider')]
    #[DependsExternal(AssertEqualsTest::class, 'itCanAssert')]
    public function itCanAssert(array $inputs, mixed $value, bool $passes): void
    {
        parent::itCanAssert($inputs, $value, $passes);
    }

    public static function assertionProvider(): array
    {
        return [
            'Single value in Array (true)' => [[new AssertEquals("FOO")], ['FOO'], true],
            'Single value in Array (false)' => [[new AssertEquals("FOO")], ['foo'], false],

            'Multiple values in Array (true)' => [[new AssertEquals("FOO")], ['FOO', 'FOO', 'FOO', 'FOO'], true],
            'Multiple values in Array (false)' => [[new AssertEquals("FOO")], ['FOO', 'foo', 'FOO', 'foo'], false],

            'Single value in DS\Sequence (true)' => [[new AssertEquals("FOO")], new Vector(['FOO']), true],
            'Single value in DS\Sequence (false)' => [[new AssertEquals("FOO")], new Vector(['foo']), false],

            'Multiple values in DS\Sequence (true)' => [[new AssertEquals("FOO")], new Vector(['FOO', 'FOO', 'FOO', 'FOO']), true],
            'Multiple values in DS\Sequence (false)' => [[new AssertEquals("FOO")], new Vector(['FOO', 'foo', 'FOO', 'foo']), false],
        ];
    }

    public function getAssertionClass(): string
    {
        return AssertContains::class;
    }
}
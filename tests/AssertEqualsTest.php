<?php

namespace Thisisboris\Assertions\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use Thisisboris\Assertions\AssertEquals;

#[CoversClass(AssertEquals::class)]
class AssertEqualsTest extends AssertionTestCase
{
    public static function assertionProvider(): array
    {
        $mockObject = new \stdClass();
        $mockArray = ['this', 'array', 'should', 'absolutely', 'match'];
        $mockString = 'This string should absolutely match';
        $mockInteger = 42;
        $mockFloat = 42.42;

        return [
            'Object (true)' => [[$mockObject], $mockObject, true],
            'Object (false)' => [[$mockObject], new \stdClass(), false],

            'Array (true)' => [[$mockArray], $mockArray, true],
            'Array (false)' => [[$mockArray], ['this', 'array', 'should', 'NOT', 'match'], false],

            'String (true)' => [[$mockString], $mockString, true],
            'String (false)' => [[$mockString], 'This string should NOT match', false],

            'Integer (true)' => [[$mockInteger], $mockInteger, true],
            'Integer (false)' => [[$mockInteger], 123456789, false],

            'Float (true)' => [[$mockFloat], $mockFloat, true],
            'Float (false)' => [[$mockFloat], 123456.1234, false],
        ];
    }

    public function getAssertionClass(): string
    {
        return AssertEquals::class;
    }
}
<?php

namespace Thisisboris\Assertions\Tests;

use Thisisboris\Assertions\AssertEnumValue;

class AssertEnumValueTest extends AssertionTestCase
{
    public static function assertionProvider(): array
    {
        return [
            'Regular Enum (true)' => [[], '', true],
            'Regular Enum (false)' => [[], '', true],

            'Int Backed Enum (true)' => [[], '', true],
            'Int Backed Enum (false)' => [[], '', true],

            'String Backed Enum (true)' => [[], '', true],
            'String Backed Enum (false)' => [[], '', true],
        ];
    }

    public function getAssertionClass(): string
    {
        return AssertEnumValue::class;
    }
}

<?php

namespace Thisisboris\Assertions\Tests;

use Ds\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use Thisisboris\Assertions\AssertType;

#[CoversClass(AssertType::class)]
class AssertTypeTest extends AssertionTestCase
{
    public static function assertionProvider(): array
    {
        return [
            'Boolean (true)' => [[new Vector(['boolean'])], true, true],
            'Boolean (false)' => [[new Vector(['boolean'])], 'string', false],

            'Object (true)' => [[new Vector(['object'])], new \stdClass(), true],
            'Object (false)' => [[new Vector(['object'])], 'string', false],

            'Array (true)' => [[new Vector(['array'])], ['an array'], true],
            'Array (false)' => [[new Vector(['array'])], 'This string should NOT match', false],

            'String (true)' => [[new Vector(['string'])], 'This string should match', true],
            'String (false)' => [[new Vector(['string'])], ['an array should not match'], false],

            'Integer (true)' => [[new Vector(['integer'])], 1234, true],
            'Integer (false)' => [[new Vector(['integer'])], 'This string should match', false],
            'Float (true)' => [[new Vector(['float'])], 1234.123, true],
            'Float (false)' => [[new Vector(['float'])], 123456, false],
        ];
    }

    public function getAssertionClass(): string
    {
        return AssertType::class;
    }
}
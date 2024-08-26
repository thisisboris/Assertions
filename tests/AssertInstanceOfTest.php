<?php

namespace Thisisboris\Assertions\Tests;

use Ds\Vector;
use PHPUnit\Framework\Attributes\CoversClass;
use Thisisboris\Assertions\AssertInstanceOf;
use Thisisboris\Assertions\Tests\Fixtures\ClassFixture;
use Thisisboris\Assertions\Tests\Fixtures\EnumFixture;
use Thisisboris\Assertions\Tests\Fixtures\InterfaceFixture;

#[CoversClass(AssertInstanceOf::class)]
class AssertInstanceOfTest extends AssertionTestCase
{
    public static function assertionProvider(): array
    {
        $mockObject = new \stdClass();
        $mockAnonymousClass = new class{};

        $mockEnum = EnumFixture::BAR;
        $mockClass = new ClassFixture();
        $mockInterfaceClass = new class implements InterfaceFixture {};

        return [
            'stdClass (true)' => [[new Vector([\stdClass::class])], $mockObject, true],
            'stdClass (false)' => [[new Vector([\stdClass::class])], $mockAnonymousClass, false],

            'Anonymous Class (true)' => [[new Vector([$mockAnonymousClass::class])], $mockAnonymousClass, true],
            'Anonymous Class (false)' => [[new Vector([$mockAnonymousClass::class])], $mockObject, false],

            'Enum (true)' => [[new Vector([EnumFixture::class])], $mockEnum, true],
            'Enum (false)' => [[new Vector([EnumFixture::class])], new class{}, false],

            'Class (true)' => [[new Vector([ClassFixture::class])], $mockClass, true],
            'Class (false)' => [[new Vector([ClassFixture::class])], new class{}, false],

            'Interface (true)' => [[new Vector([InterfaceFixture::class])], $mockInterfaceClass, true],
            'Interface (false)' => [[new Vector([InterfaceFixture::class])], new class{}, false],

            'Not-an-object (false)' => [[new Vector(['MockFakeClassName'])], 'This is not an object', false],
        ];
    }

    public function getAssertionClass(): string
    {
        return AssertInstanceOf::class;
    }
}
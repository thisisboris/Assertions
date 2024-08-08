<?php

namespace Thisisboris\Assertions;

use Thisisboris\Assertions\Exceptions\AssertException;

readonly class AssertEnumValue implements Assertion
{
    public function __construct(private string $enumClass, private bool $caseSensitive = true)
    {
        if (! enum_exists($this->enumClass) || ! isset($this->enumClass::cases()[0])) {
            throw new \InvalidArgumentException();
        }
    }

    public function getAssertionString(): string
    {
        return sprintf('is a valid %s enum value.', $this->enumClass);
    }

    public function softAssert(mixed $value): bool
    {
        if ($this->caseSensitive) {
            return $this->enumClass::tryFrom($value) !== null;
        }

        $cases = $this->enumClass::cases();

        // We can only do insensitive on strings.
        if (!$cases[0] instanceof \StringBackedEnum) return false;

        $values = array_map('strtolower', array_column($cases, 'value'));
        return in_array(strtolower($value), $values);
    }

    public function assert(mixed $value): void
    {
        if ($this->softAssert($value)) {
            return;
        }

        throw new AssertException($this);
    }

}

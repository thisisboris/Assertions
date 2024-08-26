<?php

namespace Thisisboris\Assertions;

readonly class AssertEnumValue implements Assertion
{
    use AssertsUsingSoftAssert;

    public function __construct(private string $enumClass, private bool $caseSensitive = true)
    {
        if (! enum_exists($this->enumClass)) throw new \InvalidArgumentException("Enum does not exist");
        if (! isset($this->enumClass::cases()[0]))  throw new \InvalidArgumentException("Enum is empty");
        if (! $this->enumClass::cases()[0] instanceof \BackedEnum) throw new \InvalidArgumentException("Enum is not a BackedEnum");
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
        if (! is_string($cases[0]->value)) return false;

        $values = array_map('strtolower', array_column($cases, 'value'));
        return in_array(strtolower($value), $values);
    }
}

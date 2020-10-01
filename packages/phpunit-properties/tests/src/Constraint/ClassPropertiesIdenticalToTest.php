<?php

declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Constraint;

use PHPFox\PHPUnit\ExtendsClassTrait;
use PHPFox\PHPUnit\ImplementsInterfaceTrait;
use PHPFox\PHPUnit\Properties\IdentityComparator;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPunit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \PHPFox\PHPUnit\Constraint\AbstractPropertiesConstraint
 * @covers \PHPFox\PHPUnit\Constraint\ClassPropertiesIdenticalTo
 * @covers \PHPFox\PHPUnit\Constraint\PropertiesConstraintTestTrait
 *
 * @internal
 */
final class ClassPropertiesIdenticalToTest extends TestCase
{
    use PropertiesConstraintTestTrait;
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;
    use ProvClassPropertiesTrait;

    // required by PropertiesConstraintTestTrait
    public static function getConstraintClass(): string
    {
        return ClassPropertiesIdenticalTo::class;
    }

    // required by ProvClassPropertiesTrait
    public static function getComparatorClass(): string
    {
        return IdentityComparator::class;
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassPropertiesIdenticalToSucceeds(array $expect, $actual): void
    {
        $constraint = ClassPropertiesIdenticalTo::fromArray($expect);
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassPropertiesIdenticalToFails(array $expect, $actual, string $actualString): void
    {
        $constraint = ClassPropertiesIdenticalTo::fromArray($expect);

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(self::message($actualString, 'is a class', 'identical to'));

        $constraint->evaluate($actual);
    }

    /**
     * @dataProvider provClassPropertiesNotEqualTo
     * @dataProvider provClassPropertiesNotEqualToNonClass
     * @dataProvider provClassPropertiesEqualButNotIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesIdenticalToSucceeds(array $expect, $actual): void
    {
        $constraint = new LogicalNot(ClassPropertiesIdenticalTo::fromArray($expect));
        self::assertThat($actual, $constraint);
    }

    /**
     * @dataProvider provClassPropertiesIdenticalTo
     *
     * @param mixed $actual
     */
    public function testClassNotPropertiesIdenticalToFails(array $expect, $actual, string $actualString): void
    {
        $constraint = new LogicalNot(ClassPropertiesIdenticalTo::fromArray($expect));

        $this->expectException(ExpectationFailedException::class);
        $this->expectExceptionMessage(self::message($actualString, 'fails to be a class', 'identical to'));

        $constraint->evaluate($actual);
    }
}

// vim: syntax=php sw=4 ts=4 et:

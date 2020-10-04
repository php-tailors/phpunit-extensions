<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace Tailors\PHPUnit;

use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\LogicalNot;
use Tailors\PHPUnit\Constraint\ClassPropertiesIdenticalTo;

trait ClassPropertiesIdenticalToTrait
{
    /**
     * Evaluates a \PHPUnit\Framework\Constraint matcher object.
     *
     * @param mixed $value
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    abstract public static function assertThat($value, Constraint $constraint, string $message = ''): void;

    /**
     * Asserts that selected properties of *$class* are identical to *$expected* ones.
     *
     * @param array  $expected
     *                         An array of key => value pairs with property names as keys and
     *                         their expected values as values
     * @param string $class
     *                         A name of a class to be examined
     * @param string $message
     *                         Optional failure message
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \Tailors\PHPUnit\InvalidArgumentException     when a non-string keys are found in *$expected*
     */
    public static function assertClassPropertiesIdenticalTo(
        array $expected,
        string $class,
        string $message = ''
    ): void {
        static::assertThat($class, static::classPropertiesIdenticalTo($expected), $message);
    }

    /**
     * Asserts that selected properties of *$class* are not identical to *$expected* ones.
     *
     * @param array  $expected
     *                         An array of key => value pairs with property names as keys and
     *                         their expected values as values
     * @param string $class
     *                         A name of a class to be examined
     * @param string $message
     *                         Optional failure message
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \Tailors\PHPUnit\InvalidArgumentException     when a non-string keys are found in *$expected*
     */
    public static function assertNotClassPropertiesIdenticalTo(
        array $expected,
        string $class,
        string $message = ''
    ): void {
        static::assertThat($class, new LogicalNot(static::classPropertiesIdenticalTo($expected)), $message);
    }

    /**
     * Compares selected properties of *$class* with *$expected* ones.
     *
     * @param array $expected
     *                        An array of key => value pairs with expected values of attributes
     *
     * @throws \PHPUnit\Framework\ExpectationFailedException
     * @throws \Tailors\PHPUnit\InvalidArgumentException     when non-string keys are found in *$expected*
     */
    public static function classPropertiesIdenticalTo(array $expected): ClassPropertiesIdenticalTo
    {
        return ClassPropertiesIdenticalTo::create($expected);
    }
}

// vim: syntax=php sw=4 ts=4 et:

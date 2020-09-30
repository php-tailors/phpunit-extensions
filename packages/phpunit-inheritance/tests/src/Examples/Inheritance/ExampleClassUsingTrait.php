<?php


declare(strict_types=1);

/*
 * This file is part of php-fox/phpunit-extensions.
 *
 * (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * Distributed under MIT license.
 */

namespace PHPFox\PHPUnit\Examples\Inheritance;

/**
 * Example class for testing purposes.
 */
final class ExampleClassUsingTrait
{
    use ExampleTrait;
}

// vim: syntax=php sw=4 ts=4 et:
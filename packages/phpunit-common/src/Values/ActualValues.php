<?php declare(strict_types=1);

/*
 * This file is part of php-tailors/phpunit-extensions.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\PHPUnit\Values;

/**
 * An array of actual values.
 *
 * @internal This class is not covered by the backward compatibility promise
 * @psalm-internal Tailors\PHPUnit
 */
class ActualValues extends AbstractValues
{
    /**
     * @psalm-mutation-free
     */
    final public function actual(): bool
    {
        return true;
    }
}

// vim: syntax=php sw=4 ts=4 et:
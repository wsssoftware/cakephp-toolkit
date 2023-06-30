<?php
declare(strict_types = 1);


namespace Toolkit\Utilities;

use Cake\Error\FatalErrorException;

class Colors
{

    /**
     * @param string $color
     */
    public static function validateColorOrFail(string $color): void
    {
        if (!preg_match('/^#([0-9A-F]{3}){1,2}$/i', $color)) {
            throw new FatalErrorException(sprintf('Invalid hex color %s', $color));
        }
    }
}
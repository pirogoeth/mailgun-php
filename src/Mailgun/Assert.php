<?php

namespace Mailgun;

use Mailgun\Exception\InvalidArgumentException;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Assert extends \Webmozart\Assert\Assert
{
    protected static function createInvalidArgumentException($message)
    {
        return new InvalidArgumentException($message);
    }
}

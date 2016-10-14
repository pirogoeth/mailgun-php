<?php

namespace Mailgun\Exception;

use Mailgun\Exception;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class HttpClientException extends \RuntimeException implements Exception
{
    public static function badRequest()
    {
        return new self('The parameters passed to the API were invalid. Check your inputs!');
    }

    public static function unauthorized()
    {
        return new self('Your credentials are incorrect.');
    }

    public static function requestFailed()
    {
        return new self('Parameters were valid but request failed. Try again.');
    }

    public static function notFound()
    {
        return new self('The endpoint you tried to access does not exist. Check your URL.');
    }
}

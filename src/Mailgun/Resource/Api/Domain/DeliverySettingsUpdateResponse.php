<?php

/**
 * Copyright (C) 2013-2016 Mailgun.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */
namespace Mailgun\Resource\Api\Domain;

use Mailgun\Assert;
use Mailgun\Resource\CreatableFromArray;
use Mailgun\Resource\Api\SimpleResponse;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
class DeliverySettingsUpdateResponse extends SimpleResponse implements CreatableFromArray
{
    /**
     * @var boolean
     */
    private $noVerify;

    /**
     * @var boolean
     */
    private $requireTLS;

    /**
     * @param array $data
     *
     * @return SettingsUpdateResponse|array|ResponseInterface
     */
    public static function createFromArray(array $data)
    {
        $message = array_key_exists('message', $data) ? $data['message'] : null;
        $noVerify = array_key_exists('skip_verification', $data) ? $data['skip_verification'] : null;
        $requireTLS = array_key_exists('require_tls', $data) ? $data['require_tls'] : null;

        Assert::nullOrString($message);
        Assert::nullOrBoolean($noVerify);
        Assert::nullOrBoolean($requireTLS);

        return new static(
            $message,
            $noVerify,
            $requireTLS
        );
    }

    /**
     * @param string  $message
     * @param boolean $noVerify
     * @param boolean $requireTLS
     */
    public function __construct($message, $noVerify, $requireTLS)
    {
        $this->message = $message;
        $this->noVerify = $noVerify;
        $this->requireTLS = $requireTLS;
    }

    /**
     * @return boolean
     */
    public function getSkipVerification()
    {
        return $this->noVerify;
    }

    /**
     * @return boolean
     */
    public function getRequireTLS()
    {
        return $this->requireTLS;
    }
}

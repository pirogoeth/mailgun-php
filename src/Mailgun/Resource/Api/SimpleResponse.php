<?php

/**
 * Copyright (C) 2013-2016 Mailgun.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */
namespace Mailgun\Resource\Api;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
class SimpleResponse
{
    /**
     * @var string
     */
    private $message;

    /**
     * Only set when API rate limit is hit and a rate limit response is returned.
     *
     * @var int
     */
    private $retrySeconds = null;

    /**
     * Only set on calls such as DELETE /v3/domains/.../credentials/<user>.
     *
     * @var string
     */
    private $spec = null;

    public function __construct(array $data)
    {
        $this->message = $data['message'];
        $this->retrySeconds = (array_key_exists('retry_seconds', $data) ? $data['retry_seconds'] : null);
        $this->spec = (array_key_exists('spec', $data) ? $data['spec'] : null);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getSpec()
    {
        return $this->spec;
    }

    /**
     * @return bool
     */
    public function isRateLimited()
    {
        return null !== $this->retrySeconds;
    }

    /**
     * @return int
     */
    public function getRetrySeconds()
    {
        return $this->retrySeconds;
    }
}

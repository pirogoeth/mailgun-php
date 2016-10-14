<?php

/**
 * Copyright (C) 2013-2016 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Mailgun\Resource\Api\Domains;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
class DeliverySettingsResponse
{
    /**
     * @var string
     */
    private $noVerify;

    /**
     * @var string
     */
    private $requireTLS;

    public function __construct($data)
    {
        $connSettings = $data['connection'];
        $this->noVerify = $connSettings['skip_verification'] ? 'true' : 'false';
        $this->requireTLS = $connSettings['require_tls'] ? 'true' : 'false';
    }

    /**
     * @return string
     */
    public function getSkipVerification()
    {
        return $this->noVerify;
    }

    /**
     * @return string
     */
    public function getRequireTLS()
    {
        return $this->requireTLS;
    }
}

?>

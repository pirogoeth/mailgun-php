<?php

/*
 * Copyright (C) 2013-2016 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Mailgun\Api;

use Mailgun\Assert;

/**
 * {@link https://documentation.mailgun.com/api-domains.html}
 *
 * @author Sean Johnson <sean@mailgun.com>
 */
class Domains extends AbstractApi
{
    /**
     * Returns a list of domains on the account.
     *
     * @param int $limit
     * @param int $skip
     *
     * @return \stdClass
     */
    public function listDomains($limit = 100, $skip = 0)
    {
        Assert::integer($limit);
        Assert::integer($skip);

        $params = [
            'limit' => $limit,
            'skip'  => $skip,
        ];

        return $this->get('/v3/domains', $params);
    }

    /**
     * Returns a single domain.
     *
     * @param string $domain
     *
     * @return \stdClass
     */
    public function getDomain($domain)
    {
        Assert::stringNotEmpty($domain);

        return $this->get(sprintf('/v3/domains/%s', $domain), []);
    }
}

<?php

namespace Mailgun\Api;

/**
 * {@link https://documentation.mailgun.com/api-stats.html}
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class Stats extends AbstractApi
{
    public function total($domain, array $params)
    {
        return $this->get(sprintf('/v3/%s/stats/total', $domain), $params);
    }

    public function all($domain, array $params)
    {
        return $this->get(sprintf('/v3/%s/stats', $domain), $params);
    }
}

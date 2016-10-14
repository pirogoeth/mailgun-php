<?php

namespace Mailgun\Api;


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
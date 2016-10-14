<?php

/*
 * Copyright (C) 2013-2016 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Mailgun\Tests\Api;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
class DomainsTest extends TestCase
{
    protected function getApiClass()
    {
        return 'Mailgun\Api\Domains';
    }

    /**
     * NOTE: This test uses the production Mailgun API.
     *
     * Performs `GET /v3/domains` and ensures $this->testDomain exists
     * in the returned list.
     */
    public function testDomainsList()
    {
        $mg = $this->getMailgunClient();

        $domainList = $mg->api('domains')->list()["items"];
        $this->assertEquals($domainList[0]["name"], "sandbox2970152af3d34559bfc7e71703a6cf24.mailgun.org");
    }
}

?>

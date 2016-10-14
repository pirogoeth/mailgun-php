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

        // @returns DomainListResponse
        $domainList = $mg->api('domains')->list();
        $found = false;
        foreach ($domainList->getDomains() as $domain) {
            if ($domain->getName() === $this->testDomain) {
                $found = true;
            }
        }

        $this->assertTrue($found);
    }

    /**
     * NOTE: This test uses the production Mailgun API.
     *
     * Performs `GET /v3/domains/<domain>` and ensures $this->testDomain
     * is properly returned.
     */
    public function testDomainGet()
    {
        $mg = $this->getMailgunClient();

        // @returns ComplexDomain
        $domain = $mg->api('domains')->info($this->testDomain);
        $this->assertNotNull($domain);
        $this->assertNotNull($domain->getDomain());
        $this->assertNotNull($domain->getInboundDNSRecords());
        $this->assertNotNull($domain->getOutboundDNSRecords());
        $this->assertEquals($domain->getDomain()->getState(), "active");
    }
}

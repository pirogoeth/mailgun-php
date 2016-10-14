<?php

/**
 * Copyright (C) 2013-2016 Mailgun.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */
namespace Mailgun\Resource\Api\Domains;

/**
 * ComplexDomain uses DomainTrait and exposes a "complex" constructor
 * where an array or \stdClass can be passed in to find the appropriate
 * fields.
 *
 * @author Sean Johnson <sean@mailgun.com>
 */
class ComplexDomain
{
    /**
     * @var SimpleDomain
     */
    private $domain;

    /**
     * @var DomainDnsRecord[]
     */
    private $inboundDnsRecords;

    /**
     * @var DomainDnsRecord[]
     */
    private $outboundDnsRecords;

    /**
     * @param data
     */
    public function __construct($data)
    {
        $domainInfo = $data['domain'];
        $this->domain = new SimpleDomain(
            $domainInfo['name'],
            $domainInfo['smtp_login'],
            $domainInfo['smtp_password'],
            $domainInfo['wildcard'],
            $domainInfo['spam_action'],
            $domainInfo['state'],
            new \DateTime($domainInfo['created_at'])
        );

        $inboundDns = $data['receiving_dns_records'];
        $this->inboundDnsRecords = DomainDnsRecord::createFromArray($inboundDns);

        $outboundDns = $data['sending_dns_records'];
        $this->outboundDnsRecords = DomainDnsRecord::createFromArray($outboundDns);
    }

    /**
     * @return SimpleDomain
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return DomainDnsRecord[]
     */
    public function getInboundDNSRecords()
    {
        return $this->inboundDnsRecords;
    }

    /**
     * @return DomainDnsRecord[]
     */
    public function getOutboundDNSRecords()
    {
        return $this->outboundDnsRecords;
    }
}

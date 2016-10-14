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

/**
 * ComplexDomain uses DomainTrait and exposes a "complex" constructor
 * where an array or \stdClass can be passed in to find the appropriate
 * fields.
 *
 * @author Sean Johnson <sean@mailgun.com>
 */
class ComplexDomain implements CreatableFromArray
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
     * @param array $data
     *
     * @return ComplexDomain|array|ResponseInterface
     */
    public static function createFromArray(array $data)
    {
        Assert::keyExists($data, 'domain');
        Assert::keyExists($data, 'receiving_dns_records');
        Assert::keyExists($data, 'sending_dns_records');

        // Let DomainDnsRecord::createFromArray() handle validation of
        // the `receiving_dns_records` and `sending_dns_records` data.
        // Also let SimpleDomain::createFromArray() handle validation of
        // the `domain` fields.
        return new static(
            $data['domain'],
            $data['receiving_dns_records'],
            $data['sending_dns_records']
        );
    }

    /**
     * @param data
     */
    public function __construct($domainInfo, $rxRecords, $txRecords)
    {
        $this->domain = SimpleDomain::createFromArray($domainInfo);
        $this->inboundDnsRecords = DomainDnsRecord::createFromArray($rxRecords);
        $this->outboundDnsRecords = DomainDnsRecord::createFromArray($txRecords);
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

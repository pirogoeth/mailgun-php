<?php

/**
 * Copyright (C) 2013-2016 Mailgun.
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */
namespace Mailgun\Resource\Api\Domains;

use Mailgun\Resource\CreatableFromArray;

/**
 * Represents a single DNS record for a domain.
 *
 * @author Sean Johnson <sean@mailgun.com>
 */
class DomainDnsRecord implements CreatableFromArray
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $priority;

    /**
     * @var string
     */
    private $valid;

    /**
     * @param array $data
     *
     * @return DomainDnsRecord[]
     */
    public static function createFromArray(array $data)
    {
        $items = [];

        foreach ($data as $item) {
            $items[] = new static(
                array_key_exists('name', $item) ? $item['name'] : null,
                $item['record_type'],
                $item['value'],
                array_key_exists('priority', $item) ? $item['priority'] : null,
                $item['valid']
            );
        }

        return $items;
    }

    /**
     * @param string $name
     * @param string $type
     * @param string $value
     * @param string $priority
     * @param string $valid
     */
    public function __construct($name, $type, $value, $priority, $valid)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->priority = $priority;
        $this->valid = $valid;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return ($this->valid == 'valid') ? true : false;
    }

    /**
     * @return string
     */
    public function getValidity()
    {
        return $this->valid;
    }
}

<?php

/*
 * Copyright (C) 2013-2016 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Mailgun\Resource\Api\Domains;

use Mailgun\Resource\CreatableFromArray;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
class CredentialListResponse implements CreatableFromArray
{
    /**
     * @var int
     */
    private $totalCount;

    /**
     * @var Credential[]
     */
    private $items;

    /**
     * @param array $data
     *
     * @return CredentialListResponse
     */
    public static function createFromArray(array $data)
    {
        $items = [];

        foreach ($data['items'] as $item) {
            $items[] = new Credential(
                $item['size_bytes'],
                new \DateTime($item['created_at']),
                $item['mailbox'],
                $item['login']
            );
        }

        return new self($data['total_count'], $items);
    }

    /**
     * @param int          $totalCount
     * @param Credential[] $items
     */
    public function __construct($totalCount, array $items)
    {
        $this->totalCount = $totalCount;
        $this->items = $items;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @return Credential[]
     */
    public function getCredentials()
    {
        return $this->items;
    }
}

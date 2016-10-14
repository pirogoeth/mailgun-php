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
class DomainResponse implements CreatableFromArray
{
    public static function createFromArray(array $data = [])
    {
        $items = [];

        foreach ($data['items'] as $item) {
            $items[] = new Domain(
                $item['name'],
                $item['smtp_login'],
                $item['smtp_password'],
                $item['wildcard'],
                $item['spam_action'],
                $item['state'],
                new \DateTime($item['created_at'])
            );
        }

        return new self($data['total_count'], $items);
    }
}

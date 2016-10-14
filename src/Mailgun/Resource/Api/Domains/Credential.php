<?php

/**
 * Copyright (C) 2013-2016 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Mailgun\Resource\Api\Domains;

/**
 * @author Sean Johnson <sean@mailgun.com>
 */
class Credential
{
    /**
     * @var int
     */
    private $sizeBytes;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $mailbox;

    /**
     * @var string
     */
    private $login;

    public function __construct($sizeBytes, \DateTime $createdAt, $mailbox, $login)
    {
        $this->sizeBytes = $sizeBytes;
        $this->createdAt = $createdAt;
        $this->mailbox = $mailbox;
        $this->login = $login;
    }

    /**
     * @return int
     */
    public function getSizeBytes()
    {
        return $this->sizeBytes;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getMailbox()
    {
        return $this->mailbox;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }
}

?>

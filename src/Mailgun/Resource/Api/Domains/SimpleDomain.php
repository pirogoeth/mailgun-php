<?php

/**
 * Copyright (C) 2013-2016 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Mailgun\Resource\Api\Domains;

/**
 * Represents domain information in its simplest form.
 *
 * @author Sean Johnson <sean@ramcloud.io>
 */
class SimpleDomain
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $smtpLogin;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $smtpPassword;

    /**
     * @var boolean
     */
    private $wildcard;

    /**
     * @var string
     */
    private $spamAction;

    /**
     * @var string
     */
    private $state;

    /**
     * @param string $name
     * @param string $smtpLogin
     * @param string $smtpPass
     * @param boolean $wildcard
     * @param string $spamAction
     * @param string $state
     * @param \DateTime $createdAt
     */
    public function __construct($name, $smtpLogin, $smtpPassword, $wildcard, $spamAction, $state, \DateTime $createdAt)
    {
        $this->name = $name;
        $this->smtpLogin = $smtpLogin;
        $this->smtpPassword = $smtpPassword;
        $this->wildcard = $wildcard;
        $this->spamAction = $spamAction;
        $this->state = $state;
        $this->createdAt = $createdAt;
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
    public function getSmtpUsername()
    {
        return $this->smtpLogin;
    }

    /**
     * @return string
     */
    public function getSmtpPassword()
    {
        return $this->smtpPassword;
    }

    /**
     * @return boolean
     */
    public function isWildcard()
    {
        return $this->wildcard;
    }

    /**
     * @return string
     */
    public function getSpamAction()
    {
        return $this->spamAction;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}

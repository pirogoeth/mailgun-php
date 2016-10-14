<?php

/*
 * Copyright (C) 2013-2016 Mailgun
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace Mailgun\Api;

use Mailgun\Assert;
use Mailgun\Resource\Api\Domains\ComplexDomain;
use Mailgun\Resource\Api\Domains\CredentialListResponse;
use Mailgun\Resource\Api\Domains\DeliverySettingsResponse;
use Mailgun\Resource\Api\Domains\DomainResponse;
use Mailgun\Resource\Api\Domains\DomainListResponse;
use Mailgun\Resource\Api\Domains\SettingsUpdateResponse;
use Mailgun\Resource\Api\SimpleResponse;

/**
 * {@link https://documentation.mailgun.com/api-domains.html}
 *
 * @author Sean Johnson <sean@mailgun.com>
 */
class Domains extends AbstractApi
{
    /**
     * Returns a list of domains on the account.
     *
     * @param int $limit
     * @param int $skip
     *
     * @return DomainListResponse
     */
    public function list($limit = 100, $skip = 0)
    {
        Assert::integer($limit);
        Assert::integer($skip);

        $params = array(
            'limit' => $limit,
            'skip'  => $skip,
        );

        $response = $this->get('/v3/domains', $params);

        return $this->serializer->deserialize($response, DomainListResponse::class);
    }

    /**
     * Returns a single domain.
     *
     * @param string    $domain     Name of the domain.
     *
     * @return DomainResponse
     */
    public function info($domain)
    {
        Assert::stringNotEmpty($domain);

        $response = $this->get(sprintf('/v3/domains/%s', $domain));

        return $this->serializer->deserialize($response, ComplexDomain::class);
    }

    /**
     * Creates a new domain for the account.
     * See below for spam filtering parameter information.
     * {@link https://documentation.mailgun.com/user_manual.html#um-spam-filter}
     *
     * @param string    $domain     Name of the domain.
     * @param string    $smtpPass   Password for SMTP authentication.
     * @param string    $spamAction `disable` or `tag` - inbound spam filtering.
     * @param bool      $wildcard   Domain will accept email for subdomains.
     *
     * @return ComplexDomain
     */
    public function create($domain, $smtpPass, $spamAction, $wildcard)
    {
        Assert::stringNotEmpty($domain);
        Assert::stringNotEmpty($smtpPass);
        // TODO(sean.johnson): Extended spam filter input validation.
        Assert::stringNotEmpty($spamAction);
        Assert::boolean($wildcard);

        $params = array(
            'name'          => $domain,
            'smtp_password' => $smtpPass,
            'spam_action'   => $spamAction,
            'wildcard'      => $wildcard,
        );

        $response = $this->post('/v3/domains', $params);

        return $this->serializer->deserialize($response, ComplexDomain::class);
    }

    /**
     * Removes a domain from the account.
     * WARNING: This action is irreversible! Be cautious!
     *
     * @param string    $domain     Name of the domain.
     *
     * @return ...
     */
    public function remove($domain)
    {
        Assert::stringNotEmpty($domain);

        $response = $this->delete(sprintf('/v3/domains/%s', $domain));

        return $this->serializer->deserialize($response, SimpleResponse::class);
    }

    /**
     * Returns a list of SMTP credentials for the specified domain.
     *
     * @param string    $domain     Name of the domain.
     *
     * @return CredentialsListResponse
     */
    public function credentials_list($domain, $limit = 100, $skip = 0)
    {
        Assert::stringNotEmpty($domain);
        Assert::integer($limit);
        Assert::integer($skip);

        $params = array(
            'limit' => $limit,
            'skip'  => $skip,
        );

        $response = $this->get(sprintf('/v3/domains/%s/credentials', $domain), $params);

        return $this->serializer->deserialize($response, CredentialListResponse::class);
    }

    /**
     * Create a new SMTP credential pair for the specified domain.
     *
     * @param string    $domain     Name of the domain.
     * @param string    $login      SMTP Username.
     * @param string    $pass       SMTP Password. Length min 5, max 32.
     *
     * @return CredentialResponse
     */
    public function new_credential($domain, $login, $pass)
    {
        Assert::stringNotEmpty($domain);
        Assert::stringNotEmpty($login);
        Assert::stringNotEmpty($pass);
        Assert::lengthBetween($pass, 5, 32, 'SMTP password must be between 5 and 32 characters.');

        $params = array(
            'login'     => $login,
            'password'  => $pass,
        );

        $response = $this->post(sprintf('/v3/domains/%s/credentials', $domain), $params);

        return $this->serializer->deserialize($response, CredentialResponse::class);
    }

    /**
     * Update a set of SMTP credentials for the specified domain.
     *
     * @param string    $domain     Name of the domain.
     * @param string    $login      SMTP Username.
     * @param string    $pass       New SMTP Password. Length min 5, max 32.
     *
     * @return CredentialResponse
     */
    public function update_credential($domain, $login, $pass)
    {
        Assert::stringNotEmpty($domain);
        Assert::stringNotEmpty($login);
        Assert::stringNotEmpty($pass);
        Assert::lengthBetween($pass, 5, 32, 'SMTP password must be between 5 and 32 characters.');

        $params = array(
            'password'  => $pass,
        );

        $response = $this->put(
            sprintf(
                '/v3/domains/%s/credentials/%s',
                $domain,
                $login
            ),
            $params
        );

        return $this->serializer->deserialize($response, SimpleResponse::class);
    }

    /**
     * Remove a set of SMTP credentials from the specified domain.
     *
     * @param string    $domain     Name of the domain.
     * @param string    $login      SMTP Username.
     *
     * @return ...
     */
    public function delete_credential($domain, $login)
    {
        Assert::stringNotEmpty($domain);
        Assert::stringNotEmpty($login);

        $response = $this->delete(
            sprintf(
                '/v3/domains/%s/credentials/%s',
                $domain,
                $login
            ),
            $params
        );

        return $this->serializer->deserialize($response, SimpleResponse::class);
    }

    /**
     * Returns delivery connection settings for the specified domain.
     *
     * @param string    $domain     Name of the domain.
     *
     * @return DeliverySettingsResponse
     */
    public function get_delivery_settings($domain)
    {
        Assert::stringNotEmpty($domain);

        $response = $this->get(sprintf('/v3/domains/%s/connection', $domain));

        return $this->serializer->deserialize($response, DeliverySettingsResponse::class);
    }

    /**
     * Updates the specified delivery connection settings for the specified domain.
     * If a parameter is passed in as null, it will not be updated.
     *
     * @param string    $domain     Name of the domain.
     * @param bool|null $requireTLS Enforces that messages are sent only over a TLS connection.
     * @param bool|null $noVerify   Disables TLS certificate and hostname verification.
     *
     * @return DeliverySettingsResponse
     */
    public function update_delivery_settings($domain, $requireTLS, $noVerify)
    {
        Assert::stringNotEmpty($domain);
        Assert::nullOrBoolean($requireTLS);
        Assert::nullOrBoolean($noVerify);

        $params = array();

        if (null !== $requireTLS) {
            $params['require_tls'] = $requireTLS ? 'true' : 'false';
        }

        if (null !== $noVerify) {
            $params['skip_verification'] = $noVerify ? 'true' : 'false';
        }

        $response = $this->put(sprintf('/v3/domains/%s/connection', $domain), $params);

        return $this->serializer->deserialize($response, SettingsUpdateResponse::class);
    }
}

?>

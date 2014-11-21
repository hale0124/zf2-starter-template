<?php

namespace Base\Traits;

use Elastica\Client;

/**
 * Elastica aware trait
 */
trait ElasticaAwareTrait
{
    /**
     * @var Client
     */
    protected $client = null;

    /**
     * Get elastica client
     *
     * @return Client
     */
    public function getElasticaClient()
    {
        return $this->client;
    }

    /**
     * Set elastica client
     *
     * @param Client $client
     */
    public function setElasticaClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}

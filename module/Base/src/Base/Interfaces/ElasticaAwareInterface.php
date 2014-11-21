<?php

namespace Base\Interfaces;

use Elastica\Client;

interface ElasticaAwareInterface
{
    public function getElasticaClient();
    public function setElasticaClient(Client $client);
}

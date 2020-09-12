<?php

declare(strict_types=1);

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Github\Client;
use Symfony\Component\HttpFoundation\Response;

final class RepositoryController extends AbstractFOSRestController
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getRepository(string $ownerLogin, string $repositoryName): Response
    {
        $data = $this->client->repo()->show($ownerLogin, $repositoryName);

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }
}

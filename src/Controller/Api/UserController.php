<?php

declare(strict_types=1);

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Github\Client;
use Symfony\Component\HttpFoundation\Response;

final class UserController extends AbstractFOSRestController
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getGithubUser(string $login): Response
    {
        $data = $this->client->user()->show($login);

        $view = $this->view($data, 200);

        return $this->handleView($view);
    }
}

<?php

declare(strict_types=1);

namespace Sonata\NewsBundle\Tests\Functional\Routing;

use App\Tests\App\AppKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RoutingTest extends WebTestCase
{
    /**
     * @dataProvider getRoutes
     */
    public function testRoutes(string $name, string $path, array $methods): void
    {
        $client = static::createClient();
        $router = $client->getContainer()->get('router');

        $route = $router->getRouteCollection()->get($name);

        $this->assertNotNull($route);
        $this->assertSame($path, $route->getPath());
        $this->assertEmpty(array_diff($methods, $route->getMethods()));

        $matcher = $router->getMatcher();
        $requestContext = $router->getContext();

        foreach ($methods as $method) {
            $requestContext->setMethod($method);

            // Check paths like "/api/news/posts.json".
            $match = $matcher->match($path);

            $this->assertSame($name, $match['_route']);
        }
    }

    public function getRoutes(): iterable
    {
        yield ['api_github_get_user', '/api/users/{login}', ['GET']];
        yield ['api_github_get_repository', '/api/repositories/{ownerLogin}/{repositoryName}', ['GET']];
    }

    protected static function getKernelClass(): string
    {
        return AppKernel::class;
    }
}

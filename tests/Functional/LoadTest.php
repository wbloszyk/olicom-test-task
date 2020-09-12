<?php

declare(strict_types=1);

namespace Sonata\NewsBundle\Tests\Functional\Routing;

use App\Tests\App\AppKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Stopwatch\Stopwatch;

final class LoadTest extends WebTestCase
{
    protected $client;

    protected function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    /**
     * @dataProvider getPageToTest
     */
    public function testRoutes(string $uri, string $method): void
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('requestTime');
        $this->client->request($method, $uri);
        $event = $stopwatch->stop('requestTime');
        $this->assertResponseIsSuccessful();
        $this->assertLessThanOrEqual(1000, $event->getDuration());
        $this->assertSame(200, $this->client->getResponse()->getStatusCode());
    }

    public function getPageToTest(): iterable
    {
        yield ['/api/users/wbloszyk', 'GET'];
        yield ['/api/repositories/wbloszyk/olicom-test-task', 'GET'];
    }

    protected static function getKernelClass(): string
    {
        return AppKernel::class;
    }
}

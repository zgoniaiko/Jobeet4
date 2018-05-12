<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testPageAvailable($url)
    {
        $client = static::createClient();
        $client->request('GET', $url);

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }

    public function urlProvider()
    {
        yield ['/category/'];
        yield ['/job/'];
    }
}

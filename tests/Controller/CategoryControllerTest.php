<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function testShowCategory()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/job/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Programming")')->count());

        $crawler = $client->click($crawler->selectLink('Programming')->link());
        $this->assertSame(1, $crawler->filter('h1:contains("Programming")')->count());
    }

    public function test404OnNonExistsCategory()
    {
        $client = $this->createClient();
        $crawler = $client->request('GET', '/category/non-exists');
        $this->assertSame(404, $client->getResponse()->getStatusCode());
    }
}

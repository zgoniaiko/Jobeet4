<?php

namespace App\Tests;

use App\Entity\Job;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    public function testAccesors()
    {
        $job = new Job();

        $this->assertNull($job->getId());

        $type = 'full-time';
        $this->assertNull($job->getType());
        $job->setType($type);
        $this->assertEquals($type, $job->getType());

        $company = 'test company';
        $this->assertNull($job->getCompany());
        $job->setCompany($company);
        $this->assertEquals($company, $job->getCompany());

        $logo = 'test.gif';
        $this->assertNull($job->getLogo());
        $job->setLogo($logo);
        $this->assertEquals($logo, $job->getLogo());

        $url = 'http://example.com';
        $this->assertNull($job->getUrl());
        $job->setUrl($url);
        $this->assertEquals($url, $job->getUrl());

        $position = 'Tester';
        $this->assertNull($job->getPosition());
        $job->setPosition($position);
        $this->assertEquals($position, $job->getPosition());

        $location = 'Paris, France';
        $this->assertNull($job->getLocation());
        $job->setLocation($location);
        $this->assertEquals($location, $job->getLocation());

        $description = 'test description';
        $this->assertNull($job->getDescription());
        $job->setDescription($description);
        $this->assertEquals($description, $job->getDescription());

        $howToApply = 'send email';
        $this->assertNull($job->getHowToApply());
        $job->setHowToApply($howToApply);
        $this->assertEquals($howToApply, $job->getHowToApply());

        $token = 'test_token';
        $this->assertNull($job->getToken());
        $job->setToken($token);
        $this->assertEquals($token, $job->getToken());

        $public = true;
        $this->assertNull($job->getPublic());
        $job->setPublic($public);
        $this->assertTrue($job->getPublic());

        $activated = true;
        $this->assertNull($job->getActivated());
        $job->setActivated($activated);
        $this->assertTrue($activated);

        $email = 'fake@example.com';
        $this->assertNull($job->getEmail());
        $job->setEmail($email);
        $this->assertEquals($email, $job->getEmail());
    }
}

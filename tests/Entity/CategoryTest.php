<?php

namespace App\Tests\Entity;

use App\Entity\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testAccesors()
    {
        $category = new Category();

        $this->assertNull($category->getId());

        $name = 'test name';
        $this->assertNull($category->getName());
        $category->setName($name);
        $this->assertEquals($name, $category->getName());

        $slug = 'test-slug';
        $this->assertNull($category->getSlug());
        $category->setSlug($slug);
        $this->assertEquals($slug, $category->getSlug());
    }
}

<?php

declare (strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Category;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;


class CategoryTest extends TestCase
{
    private Category $category;

    public function setUp() : void
    {
        $this->category = new Category();
    }


    public function testSettingName() : void
    {
        $this->category->setName('Category name');
        $this->assertIsString('Category name', $this->category->getName());
    }

    public function testNameCategoryNotNull() : void
    {
        $this->category->setName('Category name');
        $this->assertNotNull($this->category->getName());
    }
}
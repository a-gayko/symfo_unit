<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\CategoryController;
use PHPUnit\Framework\TestCase;

class CategoryControllerTest extends TestCase
{
    private CategoryController $controller;

    public function setUp() : void
    {
        $this->controller = $this->getMockBuilder(CategoryController::class)->disableOriginalConstructor()->getMock();
    }

    public function testIndexResponseNotNull() : void
    {
        $response = $this->controller->index();
        $this->assertNotNull($response);
    }

    public function testShowCategoryResponseNotNull() : void
    {
        $response = $this->controller->showCategory(23);
        $this->assertNotNull($response);
    }
}
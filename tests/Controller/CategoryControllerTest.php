<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\CategoryController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
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

    /**
     * @dataProvider urlProvider
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        // $this->assertResponseIsSuccessful();
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return [
            ['/en/category'],
            ['/en/category/4'],
        ];
    }
}
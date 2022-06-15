<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\Review;
use App\Controller\ReviewController;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewControllerTest extends WebTestCase
{
    private ReviewController $controller;

    public function setUp() : void
    {
        $this->controller = $this->getMockBuilder(ReviewController::class)->disableOriginalConstructor()->getMock();
    }


    public function testIndexResponseNotNull() : void
    {
        $response = $this->controller->index();
        $this->assertNotNull($response);
    }

    public function testshowReviewResponseNotNull() : void
    {
        $response = $this->controller->showReview(23);
        $this->assertNotNull($response);
    }

    public function testCreateReviewResponseNotNull() : void
    {
        $response = $this->controller->createReview(new Request());
        $this->assertNotNull($response);

    }

    public function testCreateReviewNotEmpty() : void
    {
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->any())
        ->method('persist')
        ->with($this->equalTo(new Review()));
        $this->assertNotEmpty($em);
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
            ['/en/review'],
            ['/en/review/4'],
            ['/en/review/user/create'],
            ['/en/review/user/update/2'],
            ['/en/review/user/delete/2'],
        ];
    }
}
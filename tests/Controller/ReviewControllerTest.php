<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\Review;
use App\Controller\ReviewController;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class ReviewControllerTest extends TestCase
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
}
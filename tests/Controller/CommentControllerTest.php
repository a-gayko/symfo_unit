<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\CommentController;
use App\Entity\Comment;
use App\Entity\Review;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class CommentControllerTest extends TestCase
{
    private CommentController $controller;

    private Request $request;

    private Review $review;

    public function setUp() : void
    {
        $this->controller = $this->getMockBuilder(CommentController::class)->disableOriginalConstructor()->getMock();
        $this->request = new Request();
        $this->review = new Review();
    }

    public function testIndexResponseNotNull() : void
    {
        $response = $this->controller->index();
        $this->assertNotNull($response);
    }

    public function testNewResponseNotNull() : void
    {
        $response = $this->controller->new($this->request, $this->review);
        $this->assertNotNull($response);
    }

    // public function testIndexStatusCode() : void
    // {
    //     $response = $this->controller->new($this->request, $this->review);
    //     $this->assertEquals(200, $response->getStatusCode());
    // }

    public function testNewCommentNotEmpty() : void
    {
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->any())
        ->method('persist')
        ->with($this->equalTo(new Comment()));
        $this->assertNotEmpty($em);
    }
}
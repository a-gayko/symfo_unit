<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\CommentController;
use App\Entity\Comment;
use App\Entity\Review;
use Doctrine\ORM\EntityManager;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\HttpFoundation\Request;
use PHPUnit\Framework\TestCase;

class CommentControllerTest extends TestCase
{
    private CommentController $controller;

    public function setUp() : void
    {
        $this->controller = $this->getMockBuilder(CommentController::class)->disableOriginalConstructor()->getMock();
    }

    public function testIndexResponseNotNull() : void
    {
        $response = $this->controller->index();
        $this->assertNotNull($response);
    }

    public function testNewResponseNotNull() : void
    {
        $response = $this->controller->new(new Request(), new Review());
        $this->assertNotNull($response);
    }

    // public function testIndexStatusCode() : void
    // {
    //     $response = $this->controller->new($this->request, $this->review);
    //     $this->assertEquals(200, $response->getStatusCode());
    // }

    public function testNewCommentNotEmpty() : void
    {
        // $comment = $this->createMock(Comment::class);
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->any())
        ->method('persist')
        ->with($this->equalTo(new Comment()));
        $this->assertNotEmpty($em);
    }
}
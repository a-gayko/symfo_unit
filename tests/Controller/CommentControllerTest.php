<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\CommentController;
use App\Entity\Comment;
use App\Entity\Review;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class CommentControllerTest extends WebTestCase
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

    public function testNewCommentNotEmpty() : void
    {
        // $comment = $this->createMock(Comment::class);
        $em = $this->createMock(EntityManager::class);
        $em->expects($this->any())
        ->method('persist')
        ->with($this->equalTo(new Comment()));
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
            ['/en/user/comment'],
            ['/en/user/comment/new'],
            ['/en/user/comment/4/edit'],
            ['/en/user/comment/delete/4'],
        ];
    }
}
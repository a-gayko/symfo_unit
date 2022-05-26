<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    private Comment $comment;

    public function setUp() : void
    {
        $this->comment = new Comment();
    }

    public function testTextCommentIsString() : void
    {
        $this->comment->setText('Comment text');
        $this->assertIsString($this->comment->getText());
    }

    public function testTextCommentNotNull(): void
    {
        $this->comment->setText('Comment text');
        $this->assertNotEmpty($this->comment->getText());
    }
}
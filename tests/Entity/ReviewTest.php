<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Review;
use PHPUnit\Framework\TestCase;

class ReviewTest extends TestCase
{
    private Review $review;

    public function setUp() : void
    {
        $this->review = new Review();
    }

    public function testTextReviewIsString() : void
    {
        $this->review->setText('Review Text');
        $this->assertIsString($this->review->getText());
    }

    public function testTextReviewNotNull() : void
    {
        $this->review->setText('Review Text');
        $this->assertNotEmpty($this->review->getText());
    }

     /**
     * @dataProvider dataForTextReview
     *
     */
    public function testTextReviewIsStringOrNull($input, $output) : void
    {
        $this->review->setText($input);
        $this->assertEqualsCanonicalizing($this->review->getText(), $output);
    }

    public function dataForTextReview() : array
    {
        return [
            ['Text Review', 'Text Review'],
            ['', ''],
            ['Text Review', ''],
        ];
    }
}
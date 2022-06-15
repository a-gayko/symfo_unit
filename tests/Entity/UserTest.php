<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use App\Entity\Review;
use phpDocumentor\Reflection\Types\Null_;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;

    public function setUp() : void
    {
        $this->user = new User();
    }

    public function testSettingEmail() : void
    {
        $this->user->setEmail('aleksandriam@gmail.com');
        $email = $this->user->getEmail();
        $this->assertStringNotMatchesFormat('^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,4}$', $email);
    }

    public function testSettingVerified() : void
    {
        $this->user->setIsVerified(true);
        $this->assertTrue($this->user->isVerified());
    }

    public function testGetReviewNotEmpty() : void
    {
        $this->assertNull($this->user->getReview());
    }

    /**
     * @dataProvider dataForEmail
     *
     */
    public function testSettingEmailIsStringOrNull($input, $output) : void
    {
        $this->user->setEmail($input);
        $this->assertEqualsCanonicalizing($this->user->getEmail(), $output);
    }

    public function dataForEmail() : array
    {
        return [
            ['admin@ad.min', 'admin@ad.min'],
            ['', ''],
            ['admin@ad.min', ''],
        ];
    }
}
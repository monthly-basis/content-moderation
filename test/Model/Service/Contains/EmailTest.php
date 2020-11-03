<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Contains;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{
    protected function setUp(): void
    {
        $this->emailService = new ContentModerationService\Contains\Email();
    }

    public function test_containsEmailAddress()
    {
        $this->assertFalse(
            $this->emailService->containsEmailAddress('')
        );
        $this->assertFalse(
            $this->emailService->containsEmailAddress('hello world')
        );
        $this->assertTrue(
            $this->emailService->containsEmailAddress('hello email@address.net  world')
        );
    }
}

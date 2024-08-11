<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Contains;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsSocialMediaService = new ContentModerationService\RegularExpressions\SocialMedia();
        $this->containsSocialMediaService = new ContentModerationService\Contains\SocialMedia(
            $this->regularExpressionsSocialMediaService
        );
    }

    public function testContainsImmatureWords()
    {
        $this->assertFalse(
            $this->containsSocialMediaService->containsSocialMedia('hello world')
        );
        $this->assertTrue(
            $this->containsSocialMediaService->containsSocialMedia('facebook')
        );
        $this->assertTrue(
            $this->containsSocialMediaService->containsSocialMedia('add me on instagram')
        );
    }
}

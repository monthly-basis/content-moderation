<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class SocialMediaTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsOfSocialMediaService = new ContentModerationService\RegularExpressions\SocialMedia();
        $this->replaceSocialMediaService = new ContentModerationService\Replace\SocialMedia(
            $this->regularExpressionsOfSocialMediaService
        );
    }

    public function test_replaceSocialMedia()
    {
        $replacement = 'social-media';

        $string = 'join discord';
        $this->assertSame(
            "join $replacement",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement)
        );

        $string = 'friends on facebook';
        $this->assertSame(
            "friends on $replacement",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement)
        );

        $string = 'find me on instagram';
        $this->assertSame(
            "find me on $replacement",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement)
        );

        $string = 'add me on snapchat';
        $this->assertSame(
            "add me on $replacement",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement)
        );

        $string = 'add me on tiktok';
        $this->assertSame(
            "add me on $replacement",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement)
        );
    }
}

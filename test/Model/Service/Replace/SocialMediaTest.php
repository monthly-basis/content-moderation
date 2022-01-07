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

        $string = 'snapchat on snap';
        $this->assertSame(
            "$replacement $replacement",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement)
        );

        $string = 'add me on tiktok tik tok';
        $this->assertSame(
            "add me on $replacement $replacement",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement)
        );
    }
}

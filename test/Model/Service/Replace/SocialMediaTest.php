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
        $r = 'social-media';

        /*
         * Discord
         */

        $string = 'join discord dis cord dis kord d i s c o r d D!sc0rd';
        $this->assertSame(
            "join $r $r $r $r $r",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $r)
        );

        $string = 'friends on facebook';
        $this->assertSame(
            "friends on $r",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $r)
        );

        /*
         * Instagram
         */

        $string = 'instagram tension ignoring on ig on insta my ig my insta';
        $this->assertSame(
            "$r tension ignoring $r $r $r $r",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $r)
        );

        $string = 'follow me on instagram';
        $this->assertSame(
            "follow me $r",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $r)
        );

        /*
         * Snapchat
         */

        $string = 'snapchat on snap on snapchat my snap Add my sc add me on sc';
        $this->assertSame(
            "$r $r $r $r $r $r",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $r)
        );

        /*
         * TikTok
         */

        $string = 'add me on tiktok tik tok t!k t0k TIKT0K';
        $this->assertSame(
            "add me on $r $r $r $r",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $r)
        );

        /*
         * WhatsApp
         */

        $string = 'WhatsApp';
        $this->assertSame(
            "$r",
            $this->replaceSocialMediaService->replaceSocialMedia($string, $r)
        );
    }
}

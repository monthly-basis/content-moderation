<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ToHtmlTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceBadWordsServiceMock = $this->createMock(
            ContentModerationService\Replace\BadWords::class
        );
        $this->replaceEmailAddressesServiceMock = $this->createMock(
            ContentModerationService\Replace\EmailAddresses::class
        );
        $this->replaceImmatureWordsServiceMock = $this->createMock(
            ContentModerationService\Replace\ImmatureWords::class
        );
        $this->replaceSocialMediaServiceMock = $this->createMock(
            ContentModerationService\Replace\SocialMedia::class
        );
        $this->escapeServiceMock = $this->createMock(
            StringService\Escape::class
        );
        $this->urlToHtmlServiceMock = $this->createMock(
            StringService\Url\ToHtml::class
        );

        $this->toHtmlService = new ContentModerationService\ToHtml(
            $this->replaceBadWordsServiceMock,
            $this->replaceEmailAddressesServiceMock,
            $this->replaceImmatureWordsServiceMock,
            $this->replaceSocialMediaServiceMock,
            $this->escapeServiceMock,
            $this->urlToHtmlServiceMock
        );
    }

    public function test_toHtml_stringWithSurroundingSpacesUrlsHtmlAndLineBreaks_expectedString()
    {
        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with("https://www.jiskha.com <b>bold</b>\r\n\r\n\r\n\r\n\r\n<sup>sup</sup> https://www.yahoo.com")
            ->willReturn('replace bad words return value')
            ;
        $this->replaceImmatureWordsServiceMock
            ->expects($this->once())
            ->method('replaceImmatureWords')
            ->with('replace bad words return value')
            ->willReturn('replace immature words return value')
            ;
        $this->replaceEmailAddressesServiceMock
            ->expects($this->once())
            ->method('replaceEmailAddresses')
            ->with('replace immature words return value')
            ->willReturn('replace email addresses return value')
            ;
        $this->replaceSocialMediaServiceMock
            ->expects($this->once())
            ->method('replaceSocialMedia')
            ->with('replace email addresses return value')
            ->willReturn('replace social media return value')
            ;
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->with('replace social media return value')
            ->willReturn("https://www.jiskha.com &lt;b&gt;bold&lt;/b&gt;\r\n\r\n\r\n\r\n\r\n&lt;sup&gt;sup&lt;/sup&gt; https://www.yahoo.com")
            ;
        $this->urlToHtmlServiceMock
            ->expects($this->exactly(2))
            ->method('toHtml')
            ->withConsecutive(
                ['https://www.jiskha.com'],
                ['https://www.yahoo.com']
            )
            ->willReturnOnConsecutiveCalls(
                '<a href="https://www.jiskha.com">https://www.jiskha.com</a>',
                '<a href="https://www.yahoo.com" target="_blank" rel="nofollow external noopener">https://www.yahoo.com</a>'
            );

        $stringWithSurroundingSpacesUrlsHtmlAndLineBreaks = " https://www.jiskha.com <b>bold</b>\r\n\r\n\r\n\r\n\r\n<sup>sup</sup> https://www.yahoo.com ";
        $this->assertSame(
            "<a href=\"https://www.jiskha.com\">https://www.jiskha.com</a> <b>bold</b><br />\r\n<br />\r\n<sup>sup</sup> <a href=\"https://www.yahoo.com\" target=\"_blank\" rel=\"nofollow external noopener\">https://www.yahoo.com</a>",
            $this->toHtmlService->toHtml($stringWithSurroundingSpacesUrlsHtmlAndLineBreaks)
        );
    }
}

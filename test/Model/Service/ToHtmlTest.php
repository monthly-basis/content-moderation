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

    public function test_toHtml_simpleString_simpleString()
    {
        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with('simple string')
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
            ->willReturn('escape service return value')
            ;
        $this->assertSame(
            'escape service return value',
            $this->toHtmlService->toHtml('simple string')
        );
    }

    public function test_toHtml_stringWithUrls_correctHtml()
    {
        $string = 'https://www.jiskha.com https://www.yahoo.com';
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->willReturn($string);
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

        $this->assertSame(
            '<a href="https://www.jiskha.com">https://www.jiskha.com</a> <a href="https://www.yahoo.com" target="_blank" rel="nofollow external noopener">https://www.yahoo.com</a>',
            $this->toHtmlService->toHtml($string)
        );
    }
}

<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ToHtmlTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceEmailAddressesServiceMock = $this->createMock(
            ContentModerationService\Replace\EmailAddresses::class
        );
        $this->replaceImmatureWordsServiceMock = $this->createMock(
            ContentModerationService\Replace\ImmatureWords::class
        );
        $this->replaceBadWordsServiceMock = $this->createMock(
            ContentModerationService\ReplaceBadWords::class
        );
        $this->escapeServiceMock = $this->createMock(
            StringService\Escape::class
        );
        $this->toHtmlServiceMock = $this->createMock(
            StringService\Url\ToHtml::class
        );

        $this->toHtmlService = new ContentModerationService\ToHtml(
            $this->replaceEmailAddressesServiceMock,
            $this->replaceImmatureWordsServiceMock,
            $this->replaceBadWordsServiceMock,
            $this->escapeServiceMock,
            $this->toHtmlServiceMock
        );
    }

    public function testToHtml()
    {
        $this->escapeServiceMock
             ->method('escape')
             ->willReturn('hello world');
        $string = 'hello world';
        $this->assertSame(
            'hello world',
            $this->toHtmlService->toHtml($string)
        );

        $string = "\n\n   hello world\t\t   \t\n\n";
        $this->assertSame(
            'hello world',
            $this->toHtmlService->toHtml($string)
        );
    }

    public function test_toHtml_stringWithUrls_correctHtml()
    {
        $string = 'https://www.jiskha.com https://www.yahoo.com';
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->willReturn($string);
        $this->toHtmlServiceMock
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

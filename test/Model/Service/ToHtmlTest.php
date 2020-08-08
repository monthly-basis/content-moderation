<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use LeoGalleguillos\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ToHtmlTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceBadWordsServiceMock = $this->createMock(
            ContentModerationService\ReplaceBadWords::class
        );
        $this->escapeServiceMock = $this->createMock(
            StringService\Escape::class
        );

        $this->toHtmlService = new ContentModerationService\ToHtml(
            $this->replaceBadWordsServiceMock,
            $this->escapeServiceMock
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
        $string = 'https://www.jiskha.com https://www.google.com';
        $this->escapeServiceMock
             ->method('escape')
             ->willReturn($string);

        $this->assertSame(
            '<a href="https://www.jiskha.com">https://www.jiskha.com</a> <a href="https://www.google.com" target="_blank" rel="nofollow external noopener">https://www.google.com</a>',
            $this->toHtmlService->toHtml($string)
        );
    }
}

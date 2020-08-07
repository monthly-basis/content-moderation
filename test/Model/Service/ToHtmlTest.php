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

        $this->toHtmlService = new ContentModerationService\ToHtml(
            $this->replaceBadWordsServiceMock,
            new StringService\Escape()
        );
    }

    public function testToHtml()
    {
        $this->replaceBadWordsServiceMock
             ->method('replaceBadWords')
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
}

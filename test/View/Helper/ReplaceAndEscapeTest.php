<?php
namespace MonthlyBasis\ContentModerationTest\View\Helper;

use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use MonthlyBasis\ContentModeration\View\Helper as ContentModerationHelper;
use PHPUnit\Framework\TestCase;

class ReplaceAndEscapeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceBadWordsServiceMock = $this->createMock(
            ContentModerationService\Replace\BadWords::class
        );
        $this->replaceImmatureWordsServiceMock = $this->createMock(
            ContentModerationService\Replace\ImmatureWords::class
        );
        $this->replaceSpacesServiceMock = $this->createMock(
            ContentModerationService\Replace\Spaces::class
        );
        $this->escapeServiceMock = $this->createMock(
            StringService\Escape::class
        );

        $this->replaceAndEscapeHelper = new ContentModerationHelper\ReplaceAndEscape(
            $this->replaceBadWordsServiceMock,
            $this->replaceImmatureWordsServiceMock,
            $this->replaceSpacesServiceMock,
            $this->escapeServiceMock
        );
    }

    public function test___invoke()
    {
        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->willReturn('replace bad words result');
        $this->replaceImmatureWordsServiceMock
            ->expects($this->once())
            ->method('replaceImmatureWords')
            ->willReturn('replace immature words result');
        $this->replaceSpacesServiceMock
            ->expects($this->once())
            ->method('replaceSpaces')
            ->willReturn('replace spaces result');
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->willReturn('escaped string');

        $string = 'hello world';

        $this->assertSame(
            'escaped string',
            $this->replaceAndEscapeHelper->__invoke($string)
        );
    }
}

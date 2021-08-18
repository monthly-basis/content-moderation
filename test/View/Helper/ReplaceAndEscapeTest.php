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
        $this->replaceEmailAddressesServiceMock = $this->createMock(
            ContentModerationService\Replace\EmailAddresses::class
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
            $this->replaceEmailAddressesServiceMock,
            $this->replaceImmatureWordsServiceMock,
            $this->replaceSpacesServiceMock,
            $this->escapeServiceMock
        );
    }

    public function test___invoke()
    {
        $string = '👤 hello world';

        $this->replaceBadWordsServiceMock
            ->expects($this->once())
            ->method('replaceBadWords')
            ->with(' hello world')
            ->willReturn('replace bad words result');
        $this->replaceImmatureWordsServiceMock
            ->expects($this->once())
            ->method('replaceImmatureWords')
            ->with('replace bad words result')
            ->willReturn('replace immature words result');
        $this->replaceEmailAddressesServiceMock
            ->expects($this->once())
            ->method('replaceEmailAddresses')
            ->with('replace immature words result')
            ->willReturn('replace email addresses result');
        $this->replaceSpacesServiceMock
            ->expects($this->once())
            ->method('replaceSpaces')
            ->with('replace email addresses result')
            ->willReturn('replace spaces result');
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->with('replace spaces result')
            ->willReturn('escaped string');

        $this->assertSame(
            'escaped string',
            $this->replaceAndEscapeHelper->__invoke($string)
        );
    }
}

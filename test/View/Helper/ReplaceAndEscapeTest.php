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
        $this->replaceServiceMock = $this->createMock(
            ContentModerationService\Replace::class
        );
        $this->escapeServiceMock = $this->createMock(
            StringService\Escape::class
        );

        $this->replaceAndEscapeHelper = new ContentModerationHelper\ReplaceAndEscape(
            $this->replaceServiceMock,
            $this->escapeServiceMock
        );
    }

    public function test___invoke_allBoolsOmitted_expectedString()
    {
        $string = '👤 🔪 hello world';

        $this->replaceServiceMock
            ->expects($this->once())
            ->method('replace')
            ->with($string, '', false)
            ->willReturn('replace string result')
            ;
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->with('replace string result')
            ->willReturn('escaped string')
            ;

        $this->assertSame(
            'escaped string',
            $this->replaceAndEscapeHelper->__invoke(
                string: $string,
                replacement: '',
            )
        );
    }

    public function test___invoke_allBoolsTrue_expectedString()
    {
        $string = '👤 🔪 hello world';

        $this->replaceServiceMock
            ->expects($this->once())
            ->method('replace')
            ->with($string, '', true)
            ->willReturn('replace string result')
            ;
        $this->escapeServiceMock
            ->expects($this->once())
            ->method('escape')
            ->with('replace string result')
            ->willReturn('escaped string')
            ;

        $this->assertSame(
            'escaped string',
            $this->replaceAndEscapeHelper->__invoke(
                string: $string,
                replacement: '',
                replaceSocialMedia: true,
            )
        );
    }
}

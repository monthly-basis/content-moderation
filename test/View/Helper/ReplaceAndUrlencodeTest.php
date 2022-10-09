<?php
namespace MonthlyBasis\ContentModerationTest\View\Helper;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use MonthlyBasis\ContentModeration\View\Helper as ContentModerationHelper;
use PHPUnit\Framework\TestCase;

class ReplaceAndUrlencodeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceServiceMock = $this->createMock(
            ContentModerationService\Replace::class
        );

        $this->replaceAndUrlencodeHelper = new ContentModerationHelper\ReplaceAndUrlencode(
            $this->replaceServiceMock,
        );
    }

    public function test___invoke_allBoolsOmitted_expectedString()
    {
        $string = 'hello world';

        $this->replaceServiceMock
            ->expects($this->once())
            ->method('replace')
            ->with($string, '', false, false)
            ->willReturn('replace string result')
            ;

        $this->assertSame(
            'replace+string+result',
            $this->replaceAndUrlencodeHelper->__invoke(
                string: $string,
            )
        );
    }

    public function test___invoke_allBoolsFalse_expectedString()
    {
        $string = 'hello world';

        $this->replaceServiceMock
            ->expects($this->once())
            ->method('replace')
            ->with($string, '', false, false)
            ->willReturn('replace string result')
            ;

        $this->assertSame(
            'replace+string+result',
            $this->replaceAndUrlencodeHelper->__invoke(
                string: $string,
                replacement: '',
                replaceSocialMedia: false,
                replaceSpaces: false,
            )
        );
    }

    public function test___invoke_allBoolsTrue_expectedString()
    {
        $string = 'hello world';

        $this->replaceServiceMock
            ->expects($this->once())
            ->method('replace')
            ->with($string, '', true, true)
            ->willReturn('replace string result')
            ;

        $this->assertSame(
            'replace+string+result',
            $this->replaceAndUrlencodeHelper->__invoke(
                string: $string,
                replacement: '',
                replaceSocialMedia: true,
                replaceSpaces: true,
            )
        );
    }
}

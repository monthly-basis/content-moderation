<?php
namespace MonthlyBasis\ContentModerationTest\View\Helper\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use MonthlyBasis\ContentModeration\View\Helper as ContentModerationHelper;
use PHPUnit\Framework\TestCase;

class SpacesTest extends TestCase
{
    protected function setUp(): void
    {
        $this->spacesServiceMock = $this->createMock(
            ContentModerationService\Replace\Spaces::class
        );

        $this->spacesHelper = new ContentModerationHelper\Replace\Spaces(
            $this->spacesServiceMock
        );
    }

    public function test___invoke()
    {
        $this->spacesServiceMock
            ->expects($this->once())
            ->method('replaceSpaces')
            ->willReturn('replace spaces result');

        $string = 'hello world';

        $this->assertSame(
            'replace spaces result',
            $this->spacesHelper->__invoke($string)
        );
    }
}

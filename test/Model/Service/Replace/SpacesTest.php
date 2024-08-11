<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class SpacesTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceSpacesService = new ContentModerationService\Replace\Spaces();
    }

    public function test_replaceSpaces()
    {
        $string = 'hello world';
        $this->assertSame(
            $string,
            $this->replaceSpacesService->replaceSpaces($string)
        );

        $string = 'extra     spaces';
        $this->assertSame(
            'extra spaces',
            $this->replaceSpacesService->replaceSpaces($string)
        );

        $string = ' Testing     123   ';
        $this->assertSame(
            'Testing 123',
            $this->replaceSpacesService->replaceSpaces($string)
        );
    }
}

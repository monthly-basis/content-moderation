<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class LineBreaksTest extends TestCase
{
    protected function setUp(): void
    {
        $this->replaceLineBreaksService = new ContentModerationService\Replace\LineBreaks();
    }

    public function test_replaceLineBreaks()
    {
        $string = 'no line breaks';
        $this->assertSame(
            'no line breaks',
            $this->replaceLineBreaksService->replaceLineBreaks($string)
        );

        $string = "n-breaks\n\nonly";
        $this->assertSame(
            "n-breaks\n\nonly",
            $this->replaceLineBreaksService->replaceLineBreaks($string)
        );

        $string = "r-breaks\r\ronly";
        $this->assertSame(
            "r-breaks\n\nonly",
            $this->replaceLineBreaksService->replaceLineBreaks($string)
        );

        $string = "\r\nrn-breaks\r\n\r\nonly\r\n\r\n\r\n";
        $this->assertSame(
             "\nrn-breaks\n\nonly\n\n\n",
            $this->replaceLineBreaksService->replaceLineBreaks($string)
        );

        $string = "\n\rnr-breaks\n\r\n\ronly\n\r\n\r\n\r";
        $this->assertSame(
             "\nnr-breaks\n\nonly\n\n\n",
            $this->replaceLineBreaksService->replaceLineBreaks($string)
        );

        $string = "\nmix\r\rof\n\r\r\n\n\rbreaks\r\n\n\r";
        $this->assertSame(
             "\nmix\n\nof\n\n\nbreaks\n\n",
            $this->replaceLineBreaksService->replaceLineBreaks($string)
        );
    }
}

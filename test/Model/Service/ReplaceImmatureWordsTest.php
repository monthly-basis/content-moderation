<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ReplaceImmatureWordsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsOfImmatureWordsService = new ContentModerationService\RegularExpressionsOfImmatureWords();
        $this->replaceImmatureWordsService = new ContentModerationService\ReplaceImmatureWords(
            $this->regularExpressionsOfImmatureWordsService
        );
    }

    public function testReplaceImmatureWords()
    {
        $string = "\t\tthis sentence has line breaks and no bad words\r\n\n";;
        $this->assertSame(
            $string,
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'butt kiss my';
        $this->assertSame(
            ' kiss my',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'fart by someone';
        $this->assertSame(
            ' by someone',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'idiot lol';
        $this->assertSame(
            ' lol',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'lmao lmfao too funny';
        $this->assertSame(
            '  too funny',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'poop smells';
        $this->assertSame(
            ' smells',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'retard retarded answer';
        $this->assertSame(
            ' ed answer',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'stupid questions';
        $this->assertSame(
            ' questions',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );
    }
}

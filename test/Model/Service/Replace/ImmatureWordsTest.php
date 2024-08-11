<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ImmatureWordsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsOfImmatureWordsService = new ContentModerationService\RegularExpressions\ImmatureWords();
        $this->replaceImmatureWordsService = new ContentModerationService\Replace\ImmatureWords(
            $this->regularExpressionsOfImmatureWordsService
        );
    }

    public function test_replaceImmatureWords_blankReplacement_expectedString()
    {
        $string = "\t\tthis sentence has line breaks and no bad words\r\n\n";
        $this->assertSame(
            $string,
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'arse arses arsenal parse';
        $this->assertSame(
            '  arsenal parse',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'asf really';
        $this->assertSame(
            ' really',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'butt butter';
        $this->assertSame(
            ' butter',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'damn';
        $this->assertSame(
            '',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'deeznutz deez nuts';
        $this->assertSame(
            ' ',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'dumb people dumbbell';
        $this->assertSame(
            ' people dumbbell',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'fart farts of art far that';
        $this->assertSame(
            '  of art far that',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'Hugh Jass';
        $this->assertSame(
            '',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'idfk lol';
        $this->assertSame(
            ' lol',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'idiot lol';
        $this->assertSame(
            ' lol',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'jerk person';
        $this->assertSame(
            ' person',
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

        $string = 'retard retarded retarted answer';
        $this->assertSame(
            '   answer',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );

        $string = 'stupid questions';
        $this->assertSame(
            ' questions',
            $this->replaceImmatureWordsService->replaceImmatureWords($string)
        );
    }

    public function test_replaceImmatureWords_replacementSymbols_expectedString()
    {
        $string = 'damn';
        $this->assertSame(
            '!@#$%^&',
            $this->replaceImmatureWordsService->replaceImmatureWords($string, '!@#$%^&')
        );
    }
}

<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

/**
 * WARNING
 *
 * The following code contains extremely explicit language.
 *
 * We have written code to determine whether a string contains bad words.
 *
 * In order to ensure that this code is functioning properly,
 * we must use explicit language in our own code.
 *
 * Sorry.
 */
class ContainsBadWordsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsOfBadWordsService = new ContentModerationService\RegularExpressionsOfBadWords();
        $this->containsBadWordsService = new ContentModerationService\ContainsBadWords(
            $this->regularExpressionsOfBadWordsService
        );
    }

    public function testContainsBadWords()
    {
        $string = 'bass fish kushites are delicious';
        $this->assertFalse(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'shit';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'this is bullshit';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'amazing tracy shtick';
        $this->assertFalse(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'fuck you';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'dumb F  U  C  K';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'shut the FuCk up';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'hello fucker HOLY SHIT';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = "foo faggot fagot bar DumbASS baz\n\n";
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = "ass bassoon sassy ASS\n\n";
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = ' fag wharfage';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'fukuyama fuk foo';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = 'dick tracy can suck my dick';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );

        $string = '   P u s s       y';
        $this->assertTrue(
            $this->containsBadWordsService->containsBadWords($string)
        );
    }
}

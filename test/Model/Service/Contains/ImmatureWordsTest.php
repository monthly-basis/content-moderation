<?php
namespace MonthlyBasis\ContentModerationTest\Model\Service\Contains;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;
use PHPUnit\Framework\TestCase;

class ContainsImmatureWordsTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regularExpressionsOfImmatureWordsService = new ContentModerationService\RegularExpressions\ImmatureWords();
        $this->containsImmatureWordsService = new ContentModerationService\Contains\ImmatureWords(
            $this->regularExpressionsOfImmatureWordsService
        );
    }

    public function testContainsImmatureWords()
    {
        $this->assertFalse(
            $this->containsImmatureWordsService->containsImmatureWords('hello world')
        );
        $this->assertFalse(
            $this->containsImmatureWordsService->containsImmatureWords('but far pop')
        );

        $this->assertTrue(
            $this->containsImmatureWordsService->containsImmatureWords('b.u.t.t head')
        );
        $this->assertTrue(
            $this->containsImmatureWordsService->containsImmatureWords('FARTMASTER')
        );
        $this->assertTrue(
            $this->containsImmatureWordsService->containsImmatureWords('Lick My Poop')
        );
    }
}

<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Contains;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ImmatureWords
{
    public function __construct(
        ContentModerationService\RegularExpressions\ImmatureWords $regularExpressionsOfImmatureWords
    ) {
        $this->regularExpressionsOfImmatureWords = $regularExpressionsOfImmatureWords;
    }

    public function containsImmatureWords(
        string $string
    ): bool {
        $patterns = $this->regularExpressionsOfImmatureWords
            ->getRegularExpressionsOfImmatureWords();

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $string)) {
                return true;
            }
        }

        return false;
    }
}

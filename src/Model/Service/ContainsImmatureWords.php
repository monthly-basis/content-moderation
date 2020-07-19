<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ContainsImmatureWords
{
    public function __construct(
        ContentModerationService\RegularExpressionsOfImmatureWords $regularExpressionsOfImmatureWords
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

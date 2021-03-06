<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

/**
 * @deprecated Use ContentModerationService\Contains\ImmatureWords() instead.
 */
class ContainsImmatureWords
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

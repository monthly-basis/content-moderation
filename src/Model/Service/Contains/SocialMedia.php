<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Contains;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class SocialMedia
{
    public function __construct(
        ContentModerationService\RegularExpressions\SocialMedia $regularExpressionsOfSocialMedia
    ) {
        $this->regularExpressionsOfSocialMedia = $regularExpressionsOfSocialMedia;
    }

    public function containsSocialMedia(
        string $string
    ): bool {
        $patterns = $this->regularExpressionsOfSocialMedia
            ->getRegularExpressions();

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $string)) {
                return true;
            }
        }

        return false;
    }
}

<?php
namespace MonthlyBasis\ContentModeration\Model\Service\Replace;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class SocialMedia
{
    public function __construct(
        ContentModerationService\RegularExpressions\SocialMedia $regularExpressionsOfSocialMediaService
    ) {
        $this->regularExpressionsOfSocialMediaService = $regularExpressionsOfSocialMediaService;
    }

    public function replaceSocialMedia(
        string $string,
        string $replacement
    ): string {
        $patterns = $this->regularExpressionsOfSocialMediaService
            ->getRegularExpressions();
        $string = preg_replace($patterns, $replacement, $string);
        return is_null($string) ? '' : $string;
    }
}

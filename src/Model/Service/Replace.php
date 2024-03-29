<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class Replace
{
    public function __construct(
        ContentModerationService\Replace\BadWords $replaceBadWordsService,
        ContentModerationService\Replace\EmailAddresses $replaceEmailAddressesService,
        ContentModerationService\Replace\ImmatureWords $replaceImmatureWordsService,
        ContentModerationService\Replace\SocialMedia $replaceSocialMediaService,
        ContentModerationService\Replace\Spaces $replaceSpacesService
    ) {
        $this->replaceBadWordsService       = $replaceBadWordsService;
        $this->replaceEmailAddressesService = $replaceEmailAddressesService;
        $this->replaceImmatureWordsService  = $replaceImmatureWordsService;
        $this->replaceSocialMediaService    = $replaceSocialMediaService;
        $this->replaceSpacesService         = $replaceSpacesService;
    }

    public function replace(
        string $string,
        string $replacement = '',
        bool $replaceImmatureWords = false,
        bool $replaceSocialMedia = false,
        bool $replaceSpaces = true,
    ): string {
        // Remove "Bust in Silhouette" and "Kitchen Knife" emoji from string.
        $string = preg_replace('/(\x{1F464}|\x{1F52A})/u', '', $string);

        $string = $this->replaceBadWordsService->replaceBadWords($string, $replacement);

        if ($replaceImmatureWords) {
            $string = $this->replaceImmatureWordsService->replaceImmatureWords($string, $replacement);
        }
        $string = $this->replaceEmailAddressesService->replaceEmailAddresses($string);

        if ($replaceSocialMedia) {
            $string = $this->replaceSocialMediaService->replaceSocialMedia($string, $replacement);
        }

        if ($replaceSpaces) {
            $string = $this->replaceSpacesService->replaceSpaces($string);
        }

        return $string;
    }
}

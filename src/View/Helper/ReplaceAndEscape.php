<?php
namespace MonthlyBasis\ContentModeration\View\Helper;

use Laminas\View\Helper\AbstractHelper;
use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ReplaceAndEscape extends AbstractHelper
{
    public function __construct(
        ContentModerationService\Replace\BadWords $replaceBadWordsService,
        ContentModerationService\Replace\EmailAddresses $replaceEmailAddressesService,
        ContentModerationService\Replace\ImmatureWords $replaceImmatureWordsService,
        ContentModerationService\Replace\Spaces $replaceSpacesService,
        StringService\Escape $escapeService
    ) {
        $this->replaceBadWordsService       = $replaceBadWordsService;
        $this->replaceEmailAddressesService = $replaceEmailAddressesService;
        $this->replaceImmatureWordsService  = $replaceImmatureWordsService;
        $this->replaceSpacesService         = $replaceSpacesService;
        $this->escapeService                = $escapeService;
    }

    public function __invoke(
        string $string,
        string $replacement = ''
    ): string {
        // Remove "Bust in Silhouette" and "Kitchen Knife" emoji from string.
        $string = preg_replace('/(\x{1F464}|\x{1F52A})/u', '', $string);

        $string = $this->replaceBadWordsService->replaceBadWords($string, $replacement);
        $string = $this->replaceImmatureWordsService->replaceImmatureWords($string, $replacement);
        $string = $this->replaceEmailAddressesService->replaceEmailAddresses($string);
        $string = $this->replaceSpacesService->replaceSpaces($string);

        return $this->escapeService->escape($string);
    }
}

<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ToHtml
{
    public function __construct(
        protected ContentModerationService\Replace\BadWords $replaceBadWordsService,
        protected ContentModerationService\Replace\EmailAddresses $replaceEmailAddressesService,
        protected ContentModerationService\Replace\ImmatureWords $replaceImmatureWordsService,
        protected ContentModerationService\Replace\LineBreaks $replaceLineBreaksService,
        protected ContentModerationService\Replace\SocialMedia $replaceSocialMediaService,
        protected StringService\Escape $escapeService,
    ) {
    }

    public function toHtml(
        string $string,
        bool $replaceImmatureWords = false,
        bool $replaceSocialMedia = false,
    ): string {
        // Remove BOM (Byte Order Mark)
        $string = preg_replace("/\xef\xbb\xbf/", '', $string);

        $string = $this->replaceBadWordsService->replaceBadWords($string, '');
        if ($replaceImmatureWords) {
            $string = $this->replaceImmatureWordsService->replaceImmatureWords($string, '');
        }
        $string = $this->replaceEmailAddressesService->replaceEmailAddresses($string);
        if ($replaceSocialMedia) {
            $string = $this->replaceSocialMediaService->replaceSocialMedia(
                $string,
                ''
            );
        }
        $string = $this->replaceLineBreaksService->replaceLineBreaks($string);

        $stringEscaped = $this->escapeService->escape($string);

        /*
         * Trim escaped string here in case any of the above replacements left
         * whitespace at edges of string.
         */
        $stringEscaped = trim($stringEscaped);

        $pattern        = '#&lt;(/?)(b|i|u|sub|sup)&gt;#i';
        $replacement    = '<$1$2>';
        $stringEscaped = preg_replace($pattern, $replacement, $stringEscaped);

        // Replace 3 or more \n's with just 2 \n's.
        $pattern = '/\n{3,}/s';
        $replacement = "\n\n";
        $stringEscaped = preg_replace($pattern, $replacement, $stringEscaped);

        return nl2br($stringEscaped, false);
    }
}

<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use MonthlyBasis\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ToHtml
{
    public function __construct(
        ContentModerationService\Replace\BadWords $replaceBadWordsService,
        ContentModerationService\Replace\EmailAddresses $replaceEmailAddressesService,
        ContentModerationService\Replace\ImmatureWords $replaceImmatureWordsService,
        ContentModerationService\Replace\LineBreaks $replaceLineBreaksService,
        ContentModerationService\Replace\SocialMedia $replaceSocialMediaService,
        StringService\Escape $escapeService,
        StringService\Url\ToHtml $urlToHtmlService
    ) {
        $this->replaceBadWordsService       = $replaceBadWordsService;
        $this->replaceEmailAddressesService = $replaceEmailAddressesService;
        $this->replaceImmatureWordsService  = $replaceImmatureWordsService;
        $this->replaceLineBreaksService     = $replaceLineBreaksService;
        $this->replaceSocialMediaService    = $replaceSocialMediaService;
        $this->escapeService                = $escapeService;
        $this->urlToHtmlService             = $urlToHtmlService;
    }

    public function toHtml(
        string $string,
        bool $replaceImmatureWords = false,
        bool $replaceSocialMedia = false,
    ): string {
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

        $pattern = '|https?://\S+|i';
        $stringEscaped = preg_replace_callback(
            $pattern,
            [$this, 'pregReplaceCallback'],
            $stringEscaped
        );

        $pattern        = '#&lt;(/?)(b|i|u|sub|sup)&gt;#i';
        $replacement    = '<$1$2>';
        $stringEscaped = preg_replace($pattern, $replacement, $stringEscaped);

        // Replace 3 or more \n's with just 2 \n's.
        $pattern = '/\n{3,}/s';
        $replacement = "\n\n";
        $stringEscaped = preg_replace($pattern, $replacement, $stringEscaped);

        return nl2br($stringEscaped, false);
    }

    protected function pregReplaceCallback(array $matches)
    {
        $url = $matches[0];
        return $this->urlToHtmlService->toHtml($url);
    }
}

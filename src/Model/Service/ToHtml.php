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
        string $message,
        bool $replaceSocialMedia = false,
    ): string {
        $message = $this->replaceBadWordsService->replaceBadWords($message, '');
        $message = $this->replaceImmatureWordsService->replaceImmatureWords($message, '');
        $message = $this->replaceEmailAddressesService->replaceEmailAddresses($message);
        if ($replaceSocialMedia) {
            $message = $this->replaceSocialMediaService->replaceSocialMedia(
                $message,
                ''
            );
        }
        $message = $this->replaceLineBreaksService->replaceLineBreaks($message);

        $messageEscaped = $this->escapeService->escape($message);

        /*
         * Trim escaped message here in case any of the above replacements left
         * whitespace at edges of string.
         */
        $messageEscaped = trim($messageEscaped);

        $pattern = '|https?://\S+|i';
        $messageEscaped = preg_replace_callback(
            $pattern,
            [$this, 'pregReplaceCallback'],
            $messageEscaped
        );

        $pattern        = '#&lt;(/?)(b|i|u|sub|sup)&gt;#i';
        $replacement    = '<$1$2>';
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        // Replace 3 or more \n's with just 2 \n's.
        $pattern = '/\n{3,}/s';
        $replacement = "\n\n";
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        return nl2br($messageEscaped, false);
    }

    protected function pregReplaceCallback(array $matches)
    {
        $url = $matches[0];
        return $this->urlToHtmlService->toHtml($url);
    }
}

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
        ContentModerationService\Replace\SocialMedia $replaceSocialMediaService,
        StringService\Escape $escapeService,
        StringService\Url\ToHtml $urlToHtmlService
    ) {
        $this->replaceBadWordsService       = $replaceBadWordsService;
        $this->replaceEmailAddressesService = $replaceEmailAddressesService;
        $this->replaceImmatureWordsService  = $replaceImmatureWordsService;
        $this->replaceSocialMediaService    = $replaceSocialMediaService;
        $this->escapeService                = $escapeService;
        $this->urlToHtmlService             = $urlToHtmlService;
    }

    public function toHtml(string $message): string
    {
        $message = trim($message);
        $message = $this->replaceBadWordsService->replaceBadWords($message, '');
        $message = $this->replaceImmatureWordsService->replaceImmatureWords($message, '');
        $message = $this->replaceEmailAddressesService->replaceEmailAddresses($message);
        $message = $this->replaceSocialMediaService->replaceSocialMedia($message, '');

        $messageEscaped = $this->escapeService->escape($message);

        $pattern = '|https?://\S+|i';
        $messageEscaped = preg_replace_callback(
            $pattern,
            [$this, 'pregReplaceCallback'],
            $messageEscaped
        );

        $pattern        = '#&lt;(/?)(b|i|u|sub|sup)&gt;#i';
        $replacement    = '<$1$2>';
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        // Replace 3 or more line breaks with just 2 line breaks.
        $pattern = '/(\r\n){3,}/s';
        $replacement = "\r\n\r\n";
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        return nl2br($messageEscaped);
    }

    protected function pregReplaceCallback(array $matches)
    {
        $url = $matches[0];
        return $this->urlToHtmlService->toHtml($url);
    }
}

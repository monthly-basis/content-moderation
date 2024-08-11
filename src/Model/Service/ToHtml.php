<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

use LeoGalleguillos\String\Model\Service as StringService;
use MonthlyBasis\ContentModeration\Model\Service as ContentModerationService;

class ToHtml
{
    public function __construct(
        ContentModerationService\ReplaceBadWords $replaceBadWordsService,
        StringService\Escape $escapeService
    ) {
        $this->replaceBadWordsService = $replaceBadWordsService;
        $this->escapeService          = $escapeService;
    }

    public function toHtml(string $message): string
    {
        $message = trim($message);
        $message = $this->replaceBadWordsService->replaceBadWords($message);

        $messageEscaped = $this->escapeService->escape($message);

        $pattern = '|(https?://(?!(www\.)?jiskha\.com)[^\s]+)|i';
        $replacement = '<a href="$1" target="_blank" rel="nofollow external noopener">$1</a>';
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        $pattern = '|(https?://(?=(www\.)?jiskha\.com)[^\s]+)|i';
        $replacement = '<a href="$1">$1</a>';
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        $pattern        = '#&lt;(/?)(b|i|u|sub|sup)&gt;#i';
        $replacement    = '<$1$2>';
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        // Replace 3 or more line breaks with just 2 line breaks.
        $pattern = '/(\r\n){3,}/s';
        $replacement = "\r\n\r\n";
        $messageEscaped = preg_replace($pattern, $replacement, $messageEscaped);

        return nl2br($messageEscaped);
    }
}

<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

class SocialMedia
{
    public function getRegularExpressions(): array
    {
        return [
            '/facebook/i',
            '/instagram/i',
            '/snapchat/i',
            '/twitch/i',
            '/youtube/i',
        ];
    }
}

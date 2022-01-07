<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

class SocialMedia
{
    public function getRegularExpressions(): array
    {
        return [
            '/discord/i',
            '/facebook/i',
            '/instagram/i',
            '/snapchat/i',
            '/tiktok/i',
        ];
    }
}

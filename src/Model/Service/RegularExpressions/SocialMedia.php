<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

class SocialMedia
{
    public function getRegularExpressions(): array
    {
        return [
            '/discord/i',
            '/facebook/i',

            '/\bon ig\b/i',
            '/instagram/i',

            '/(my|on) snap/i',
            '/snapchat/i',

            '/tik ?tok/i',
        ];
    }
}

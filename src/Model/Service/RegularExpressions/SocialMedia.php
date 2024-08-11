<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

class SocialMedia
{
    public function getRegularExpressions(): array
    {
        return [
            '/discord/i',
            '/facebook/i',

            /*
             * Instagram
             */
            // Prioritize full name of social network
            '/instagram/i',
            '/\b(on|my) (ig\b|insta)/i',

            '/(my|on) snap/i',
            '/snapchat/i',

            '/tik ?tok/i',
        ];
    }
}

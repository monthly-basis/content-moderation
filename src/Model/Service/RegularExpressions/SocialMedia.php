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
            // Prioritize longer phrase
            '/\b(on|my) (ig\b|insta(gram)?)/i',
            '/instagram/i',

            /*
             * Snapchat
             */
            // Prioritize longer phrase
            '/(my|on) snap(chat)?/i',
            '/snapchat/i',

            '/tik ?tok/i',
        ];
    }
}

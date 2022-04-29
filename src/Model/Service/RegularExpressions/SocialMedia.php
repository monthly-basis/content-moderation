<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

class SocialMedia
{
    public function getRegularExpressions(): array
    {
        return [
            /*
             * Discord
             */
            '/d\s?[i!]\s?s\s?[ck]\s?[o0]\s?r\s?d/i',

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

            // sc
            '/add (me on|my) sc/i',

            '/t[i!]k ?t[o0]k/i',
        ];
    }
}

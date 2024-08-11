<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

class ImmatureWords
{
    public function getRegularExpressionsOfImmatureWords(
    ): array {
        return [
            '/\barses?\b/i',
            '/asf/i',
            '/boob(ies|s)?/i',
            '/booty/i',
            '/b\W*u\W*t\W*t\b/i',
            '/\bcrap(?:s|y|ped|ping)?/i', 
            '/damn/i',
            '/de(e|z)(s|z)\s?nut(s|z)/i',
            '/dumb\b/i',
            '/\bf\W*a\W*r\W*t(\W*s)?\b/i',
            '/Hugh Jass/i',
            '/idfk/i',
            '/idiot(ic|s)?/i',
            '/jerk/i',
            '/lmf?ao/i',
            '/p\W*o\W*o\W*p/i',
            '/retar(d|t)(ed)?/i',
            '/stupid/i',
            '/sucks?/i',
            '/wtf/i',
        ];
    }
}

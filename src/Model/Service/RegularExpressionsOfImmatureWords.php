<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

class RegularExpressionsOfImmatureWords
{
    public function getRegularExpressionsOfImmatureWords(
    ): array {
        return [
            '/\barses?\b/i',
            '/asf/i',
            '/b\W*u\W*t\W*t\b/i',
            '/damn/i',
            '/dee(s|z)\s?nut(s|z)/i',
            '/dumb\b/i',
            '/f\W*a\W*r\W*t/i',
            '/idfk/i',
            '/idiot/i',
            '/lmf?ao/i',
            '/p\W*o\W*o\W*p/i',
            '/retard/i',
            '/stupid/i',
            '/wtf/i',
        ];
    }
}

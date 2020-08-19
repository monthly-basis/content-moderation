<?php
namespace MonthlyBasis\ContentModeration\Model\Service;

class RegularExpressionsOfImmatureWords
{
    public function getRegularExpressionsOfImmatureWords(
    ): array {
        return [
            '/b\W*u\W*t\W*t/i',
            '/f\W*a\W*r\W*t/i',
            '/idiot/i',
            '/lmf?ao/i',
            '/p\W*o\W*o\W*p/i',
            '/retard/i',
        ];
    }
}

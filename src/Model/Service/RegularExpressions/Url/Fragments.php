<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions\Url;

class Fragments
{
    public function getRegularExpressions(): array
    {
        return [
            /*
             * http
             */
            '/http/i',

            /*
             * .com
             */
            '/\.[c𝐜𝙘][o𝐨𝙤][m𝐦𝙢]/i',
        ];
    }
}

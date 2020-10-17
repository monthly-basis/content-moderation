<?php
namespace MonthlyBasis\ContentModeration\Model\Service\RegularExpressions;

/**
 * WARNING
 *
 * The following code contains extremely explicit language.
 *
 * In order to ensure that this code is functioning properly,
 * we must use explicit language in our own code.
 *
 * @TODO Also, in future versions of this software, "bad" words will be
 * divided into more-specific categories. For example, a word dealing
 * with sex should be in a category called "sex" and should not always be
 * categorized as "bad".
 */
class BadWords
{
    public function getRegularExpressionsOfBadWords(): array
    {
        return [
            /*
             * Test string to trigger bad word detectors in production
             * for users who should not have to type a bad word.
             */
            '/ozeybhv/',

            '/8={2,}D/i',

            /*
             * ass
             *
             * Cannot use word boundary (\b) around dollar sign because
             * dollar sign is not a word character.
             * So, just hard-code some variations for now.
             */
            '/\ba\s*ss(es)?\b/i',
            '/\bazz\b/i',
            '/a(s|\$)\$/i',
            '/a\$(s|\$)/i',
            '/\ba\*\*/i',
            '/@ss/i',
            '/@\$\$/i',
            '/\bas(s|\W)hole/i',
            '/\ba holes\b/i',
            '/a§š/i',
            '/dumb?ass/i',
            '/dumba\W\W/i',

            '/suck balls?/i',

            '/bastard/i',

            /*
             * Cannot use word boundary (\b) around non-word characters (\W).
             */
            '/biach/i',
            '/b\W*(i\W*)?t\W*c\W*h(es)?\b/i',
            '/bi+(t|\W)c(h|\W)/i',
            '/bict?h/i',
            '/bi\dch/i',
            '/a b\*+/i',
            '/biyach/i',

            // Symbols
            '/[bʙ][1lï]t?[cʨ]h/iu',

            '/blow\W*j\W*o\W*b/i',

            /*
             * boner
             */
            '/boner/i',

            '/\bboobs\b/i',
            '/bullshi?t/i',
            '/\bclit\b/i',

            '/cock\s*suck/i',
            '/c0ck/i',

            /*
             * cooch
             */
            '/\bcooch(ie)?/i',

            '/\bcum\b/i',

            // The following results in a PREG_BACKTRACK_LIMIT_ERROR in some cases.
            //'/\bc(\W|\_| )*(u|\W) ?n ?ts?\b/i',
            '/\bc\s*u\s*n\s*t/i',
            '/\bc(\W|_)*u\W*n\W*t(\W*s)?\b/i',
            '/\bc\Wnt/i',

            '/dammit/i',
            '/damnit/i',

            '/douche/i',

            /*
             * dick
             */

            // letters
            '/d+i+c+k+\b/i',

            // symbols
            '/d\W?[\!1i][ck]k\b/i',
            '/d[\!\#\*]{2}k/i',

            // variations
            '/dickhead/i',
            '/dicks/i',

            '/f(a|4)g/i',
            '/fap/',
            '/fleshlight/i',
            '/foreskin/i',

            /*
             * fuck
             */

            '/\bf(###|\*\*\*|\-\-\-)/i',
            '/\bf[^\w\=\/\( ]+k/i',
            '/\bf\W+ck/i',
            '/\bf\W*a\W*g\b/i',

            '/\bfu\W?k\b/i',
            '/fu\W?king?/i',

            '/WHAT THE FK/i',

            // Foreign alphabets and symbols
            '/(f|ƒ)(u|μ)(c|¢|ς)(k|κ)/i',
            '/\bf_u?ck/i',

            '/f(\W)*(u|v)e?\W*c\W*k/i',
            '/\bf\W*c\W*k\b/i',
            '/\bf off\b/i',
            '/\bfuc/i',

            /*
             * gay
             */

            '/gay/i',

            // Spaces
            '/\bg ay\b/i',

            // Symbols
            '/g[\.\_]a[\.\_]y/i',

            // Variations
            '/\bgae\b/i',

            '/god ?damn/i',

            '/\bhoe/i',
            '/\bhorne?y/i',

            '/jigaboo/i',
            '/jackass/i',
            '/kike/i',
            '/\bkys\b/i',
            '/lesbian/i',
            '/mast(e|u)rbat(ion)?/i',
            '/\bmilf\b/i',

            /*
             * nigger
             */
            '/[nɴΝ]\W*[1il\!\¡]\W*g\W*g/i',
            '/\/VIGGA/i',
            '/ngga/i',
            '/n[\!i][9q][9q](a|er)?/i',
            '/\bnicker\b/i',
            '/\bnig\b/i',
            '/nogger/i',

            // Spellings
            '/ni?gge?r/i',

            // Variations
            '/knee garr?/i',
            '/nick gurr?/i',
            '/niglet/i',
            '/\bn ?word\b/i',

            '/orgasm/i',

            '/penn?[iu][5s]/i',

            '/perv(ert|s|\b)/i',

            '/phuck/i',

            '/\bp\s*o\s*(r|ɾ)\s*n/i',
            '/\bp(o|\W)rn/i',

            /*
             * pussy
             */
            '/p\s*u\s*s\s*s\s*y/i',
            '/p\W*u\W*[s\$]\W*[s\$]\W*y/i',
            '/pussi(es)?/i',

            /*
             * rape
             */
            '/\brape[ds]?/i',
            '/\brapist/i',

            /*
             * shit
             */
            '/\bs\W*h(\W*(i|1)\W*|\W+)t/i',

            // Symbols
            '/[\$\§]h![t\ł]/iu',

            '/\bstfu/i',

            '/s(l|1)(u|ü)t/i',
            '/suck my/i',

            '/\btits?\b/i',
            '/titties/i',

            '/vagina/i',
            '/wh(o|0)re/i',
            '/w\s+h\s+o\s+r\s+e/i',
            '/xhamster/i',
            '/xvideos/i',
        ];
    }
}
